<?php

namespace App\Http\Controllers;

use App\Enums\OrderItemStatus;
use App\Enums\OrderStatus;
use App\Enums\WarehouseStatus;
use App\Filter\OrderFilter;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Warehouse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function index(Request $request, OrderFilter $orderFilter)
    {
        try {
            $isAdmin = (new WarehouseController())->checkAdmin();
            $listOrderItems = null;
            if ($isAdmin) {
                $orders = Order::filter($orderFilter)->get();
            } else {
                $orders = Order::where([['user_id', Auth::user()->id], ['status', OrderStatus::PAYMENT_SUCCESS]])->get();
            }
            foreach ($orders as $order) {
                $orderItems = OrderItem::where('order_id', $order->id)->get();
                foreach ($orderItems as $orderItem) {
                    $listOrderItems[] = $orderItem;
                }
            }

            $status = $request->input('statusList');
            $listOrderItemStatus = null;
            if ($status != null && $listOrderItems != null) {
                foreach ($listOrderItems as $item) {
                    if ($item->status == $status) {
                        $listOrderItemStatus[] = $item;
                    }
                }
                $listOrderItems = $listOrderItemStatus;
            }

            $warehouses = Warehouse::where('status', WarehouseStatus::ACTIVE)->get();
            $reflector = new \ReflectionClass('App\Enums\OrderItemStatus');
            $statusList = $reflector->getConstants();
            return view('pages/orders/order-manager', compact('orders', 'listOrderItems', 'statusList', 'warehouses'));
        } catch (\Exception $exception) {
            return back();
        }
    }

    public function review($id)
    {
        try {
            $isAdmin = (new WarehouseController())->checkAdmin();
            $orderItem = OrderItem::where('id', $id)->first();
            if ($isAdmin) {
                return view('pages/orders/order-review', compact('orderItem'));
            }
            return redirect(route('order.manager.index'));
        } catch (\Exception $exception) {
            return redirect(route('order.manager.index'));
        }
    }

    public function createOrderItems($id)
    {
        try {
            $isAdmin = (new WarehouseController())->checkAdmin();
            $orderItem = OrderItem::where('id', $id)->first();
            if ($isAdmin) {
                $orderItem->status = OrderItemStatus::CREATED_ORDER;
                $orderItem->save();
                return redirect(route('order.manager.index'));
            }
        } catch (\Exception $exception) {
            return redirect(route('order.manager.index'));
        }
    }

    public function list()
    {
        try {
            $isAdmin = (new WarehouseController())->checkAdmin();
            if ($isAdmin) {
                $orders = Order::where('status', '!=', OrderStatus::DELETED)->get();
            } else {
                $orders = Order::where([['user_id', Auth::user()->id], ['status', '!=', OrderStatus::DELETED]])->get();
            }
            return view('pages/orders/list', compact('orders'));
        } catch (\Exception $exception) {
            return back();
        }
    }

    public function detail($id)
    {
        try {
            $isAdmin = (new WarehouseController())->checkAdmin();
            $order = Order::where('id', $id)->first();
            $orderItems = OrderItem::where('order_id', $order->id)->get();
            return view('pages/orders/detail', compact('order', 'orderItems'));
        } catch (\Exception $exception) {
            return back();
        }
    }

    public function updateOrder(Request  $request, $id)
    {
        try {
            $isAdmin = (new WarehouseController())->checkAdmin();
            if ($isAdmin) {
                $order = Order::find($id);
                $status = $request->input('status');
                $order->status = $status;
                $order->save();

                $email = Auth::user()->email;

                $content = null;
                switch ($status){
                    case OrderStatus::ARRIVED_WAREHOUSE:
                        $content = 'Your order has been successfully to the warehouse';
                        break;
                    case $status == OrderStatus::SHIPPING:
                        $content = 'Your order is being shipped';
                        break;
                    case OrderStatus::DELIVERED:
                        $content = 'Your order has been successfully delivered';
                        break;
                    case $status == OrderStatus::CANCELED:
                        $content = 'Your order has been cancelled';
                        break;
                    default:
                        $content = 'Your order has been successfully';
                        break;
                }

                $data = array(
                    'email' => $email,
                    'content' => $content
                );

                Mail::send('layouts/mail/user/update-order', $data, function ($message) use ($email) {
                    $message->to($email, 'Notification mail!')->subject
                    ('Notification mail');
                    $message->from('supprot.ilvietnam@gmail.com', 'Support IL');
                });
            }

            return redirect(route('order.list'))->with('success', 'Change status order success');
        } catch (\Exception $exception) {
            return back();
        }
    }
}
