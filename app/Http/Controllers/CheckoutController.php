<?php

namespace App\Http\Controllers;

use App\Enums\DepositStatus;
use App\Enums\WarehouseStatus;
use App\Models\Cart;
use App\Models\Deposit;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
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

        $email = Auth::user()->email;

        $order = Order::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->first();
        $warehouse = Warehouse::find($ware_house);
        $deposit = Deposit::where([
            ['address_from', 'cn'],
            ['address_to', $warehouse->country],
            ['status', DepositStatus::ACTIVE]
        ])->first();

        $orderList = OrderItem::where('order_id', $order->id)->get();

//        $totalPrice = $cartItems->sum('total_price') +
//            $deposit->shipping_fee +
//            (($cartItems->sum('total_price') * $deposit->tax_percent) / 100);
//        $pricePercent = ($totalPrice * $deposit->price_percent) / 100;

        $currency = (new BaseController())->getLocation($request);
        $productPrice = convertCurrency('CNY', $currency, $cartItems->sum('total_price'));
        $totalPrice = $productPrice + ($productPrice * $deposit->tax_percent) / 100;
        if ($currency == 'VND'){
            $totalPrice = number_format($totalPrice, 0, ',', '.');
        }
        $pricePercent = ($totalPrice * $deposit->price_percent) / 100;
        $priceMissing = number_format($totalPrice - $pricePercent, 3, ',', '.');
        $pricePercent = number_format($pricePercent, 3, ',', '.');

        $data = array(
            'email' => $email,
            'name' => $email,
            'orderList' => $orderList,
            'pricePercent' => $pricePercent,
            'priceMissing' => $priceMissing,
            'currency' => $currency
        );


        Mail::send('layouts/mail/user/checkout-mail', $data, function ($message) use ($email) {
            $message->to($email, 'Notification mail!')->subject
            ('Notification mail');
            $message->from('supprot.ilvietnam@gmail.com', 'Support IL');
        });

        $emailAdmin = env('MAIL_ADMIN', 'ngodaix5tp@gmail.com');
        $data = array(
            'email' => $emailAdmin,
            'currency' => $currency
        );
        Mail::send('layouts/mail/admin/admin-checkout-mail', $data, function ($message) use ($emailAdmin) {
            $message->to($emailAdmin, 'Notification mail!')->subject
            ('Notification mail');
            $message->from('supprot.ilvietnam@gmail.com', 'Support IL');
        });

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
