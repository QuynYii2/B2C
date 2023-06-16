<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        try {
            $isAdmin = (new WarehouseController())->checkAdmin();
            $listOrderItems = null;
            if ($isAdmin) {
                $orders = Order::where('status', 'payment_success')->get();
            } else {
                $orders = Order::where([['user_id', Auth::user()->id], ['status', 'payment_success']])->get();
            }
            foreach ($orders as $order) {
                $orderItems = OrderItem::where('order_id', $order->id)->get();
                foreach ($orderItems as $orderItem) {
                    $listOrderItems[] = $orderItem;
                }
            }
            return view('pages/orders/order-manager', compact('orders', 'listOrderItems'));
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
}
