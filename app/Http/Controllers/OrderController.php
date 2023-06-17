<?php

namespace App\Http\Controllers;

use App\Enums\OrderItemStatus;
use App\Filter\OrderItemFilter;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index(OrderItemFilter $orderItemFilter)
    {
        try {
            $isAdmin = (new WarehouseController())->checkAdmin();
            $listOrderItems = null;
            if ($isAdmin) {
                $orders = Order::where('status', 'payment_success')->get();
                $listOrderItems = OrderItem::filter($orderItemFilter)->get();
            } else {
                $orders = Order::where([['user_id', Auth::user()->id], ['status', 'payment_success']])->get();
                foreach ($orders as $order) {
                    $orderItems = OrderItem::where('order_id', $order->id)->get();
                    foreach ($orderItems as $orderItem) {
                        $listOrderItems[] = $orderItem;
                    }
                }
            }
            $reflector = new \ReflectionClass('App\Enums\OrderItemStatus');
            $statusList = $reflector->getConstants();
            return view('pages/orders/order-manager', compact('orders', 'listOrderItems', 'statusList'));
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
