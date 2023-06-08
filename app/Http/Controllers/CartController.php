<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $product = Cart::where('user_id', Auth::id())
            ->where('product_name', $request->input('product_name'))
            ->where('attribute->color', $request->input('product_color'))
            ->where('attribute->size', $request->input('product_size'))
            ->first();

        if ($product) {
            $newQuantity = $product->quantity + $request->input('product_quanlity');
            $newTotalPrice = $newQuantity * $request->input('product_price');

            $product->update([
                'quantity' => $newQuantity,
                'total_price' => $newTotalPrice
            ]);
        } else {
            $total = $request->input('product_quanlity') * $request->input('product_price');
            $mergedAttribute = [
                'size' => $request->input('product_size'),
                'color' => $request->input('product_color')
            ];

            Cart::create([
                'user_id' => Auth::id(),
                'product_name' => $request->input('product_name'),
                'product_url' => $request->input('product_url'),
                'attribute' => $mergedAttribute,
                'quantity' => $request->input('product_quanlity'),
                'image' => $request->input('product_img'),
                'price' => $request->input('product_price'),
                'total_price' => $total
            ]);
        }

        return response()->json(['success' => true]);
    }


    public function showCart(){
        $carts = Cart::where('user_id', Auth::id())->get();

        return view('pages/cart-index', [
            'listCart' => $carts
        ]);
    }

    public function updateQuantity(Request $request) {

        $itemId = $request->input('itemId');
        $quantity = $request->input('quantity');

        $cart = Cart::find($itemId);
        if (!$cart) {
            return response()->json(['success' => false, 'message' => 'Hàng không tồn tại'], 404);
        }
        $newTotalPrice  = $cart->price * $quantity;

        $cart->quantity = $quantity;
        $cart->total_price = $newTotalPrice;
        $cart->save();
        $priceTotal =  Cart::where('user_id', Auth::id())->sum('total_price');

        return response()->json([
            'success' => true,
            'totalPrice' => $newTotalPrice,
            'priceTotal' => $priceTotal
        ]);
    }

    public function deleteCartItem(Request $request)
    {
        $itemId = $request->itemId;
        $cart = Cart::findOrFail($itemId);
        $cart->delete();

        return response()->json([
            'success' => true
        ]);
    }

    public function deleteAllCartItems()
    {
        return response()->json([
            'success' => true
        ]);
    }

}

