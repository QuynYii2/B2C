<?php

namespace App\Http\Controllers;

use App\Enums\OrderItemStatus;
use App\Enums\WarehouseStatus;
use App\Filter\OrderFilter;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Warehouse;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index(Request $request, OrderFilter $orderFilter)
    {
        try {
            $isAdmin = (new WarehouseController())->checkAdmin();
            $listOrderItems = null;
            if ($isAdmin) {
                $orders = Order::filter($orderFilter)->get();
                $status = $request->input('status');
                if ($status != null) {
                    foreach ($orders as $order) {
                        $orderItems = OrderItem::where('order_id', $order->id)->get();
                        foreach ($orderItems as $orderItem) {
                            if ($orderItem->status = $status) {
                                $listOrderItems[] = $orderItem;
                            }
                        }
                    }
                } else {
                    foreach ($orders as $order) {
                        $orderItems = OrderItem::where('order_id', $order->id)->get();
                        foreach ($orderItems as $orderItem) {
                            $listOrderItems[] = $orderItem;
                        }
                    }
                }
            } else {
                $orders = Order::where([['user_id', Auth::user()->id], ['status', 'payment_success']])->get();
                foreach ($orders as $order) {
                    $orderItems = OrderItem::where('order_id', $order->id)->get();
                    foreach ($orderItems as $orderItem) {
                        $listOrderItems[] = $orderItem;
                    }
                }
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
}
