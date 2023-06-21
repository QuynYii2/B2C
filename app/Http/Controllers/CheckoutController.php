<?php

namespace App\Http\Controllers;

use App\Enums\WarehouseStatus;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class CheckoutController extends Controller
{

    public function show(Request $request)
    {
        $currency = (new BaseController())->getLocation($request);

        $carts = Cart::where('user_id', Auth::id())->get();
        $infoUser = User::find(Auth::id());
        $allWareHouse = Warehouse::where('status', WarehouseStatus::ACTIVE)->get();

        return view('pages/checkout', [
            'cartItems' => $carts,
            'user' => $infoUser,
            'allWareHouse' => $allWareHouse,
            'currency' => $currency
        ]);
    }

    public function createPayment(Request $request)
    {
        $price = $request->input('total-checkout');
        $name = $request->input('full_name');
        $email = $request->input('email');
        $phone = $request->input('phone');
        $address = $request->input('address');
        $ware_house = $request->input('ware_house');

        $response = (new PayPalController())->paypalTotal($request, $price, route('checkout.success', [
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'address' => $address,
            'ware_house' => $ware_house,
        ]));

        if (isset($response['id']) && $response['id'] != null) {
            foreach ($response['links'] as $links) {
                if ($links['rel'] == 'approve') {
                    return redirect()->away($links['href']);
                }
            }

            return redirect()
                ->route('checkout.show')
                ->with('error', 'Something went wrong.');

        } else {
            return redirect()
                ->route('checkout.show')
                ->with('error', $response['message'] ?? 'Something went wrong back');
        }
    }

    public function successPayment(Request $request, $name, $email, $phone, $address, $ware_house)
    {

        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request['token']);

        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
            $payment = $this->processPayment($request, $name, $email, $phone, $address, $ware_house);
            return redirect()
                ->route('index')
                ->with('success', 'Transaction complete.');
        } else {
            return redirect()
                ->route('checkout.show')
                ->with('error', $response['message'] ?? 'Something went wrong.');
        }
    }

    private function processPayment(Request $request, $name, $email, $phone, $address, $ware_house)
    {

        $order = Order::create([
            'user_id' => Auth::id(),
            'payment_method' => 'PAYPAL',
            'customer_name' => $name,
            'customer_address' => $email,
            'customer_phone' => $phone,
            'customer_email' => $address,
            'warehouse_id' => $ware_house,
            'status' => 'payment_success',
        ]);

        $cartItems = Cart::where('user_id', Auth::id())->get();
        foreach ($cartItems as $cartItem) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $cartItem->product_id,
                'product_name' => $cartItem->product_name,
                'attribute' => json_encode($cartItem->attribute),
                'product_url' => $cartItem->product_url,
                'quantity' => $cartItem->quantity,
                'image' => $cartItem->image,
                'price' => $cartItem->price,
                'total_price' => $cartItem->total_price,
            ]);
        }

        Cart::where('user_id', Auth::id())->delete();

        return $order;
    }

    public function cancelPayment()
    {
        return redirect()
            ->route('checkout.show')
            ->with('error', $response['message'] ?? 'You have canceled the transaction.');
    }
}
