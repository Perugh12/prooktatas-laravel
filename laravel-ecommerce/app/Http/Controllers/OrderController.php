<?php

namespace App\Http\Controllers;

use App\Models\Cart;

class OrderController extends Controller
{
    public function index()
    {
        if (!$this->issetOrder()) {
            $this->createOrder();
        }
        
        return view('order.index');
    }

    private function issetOrder(){
        return isset(request()->session()->get('order')['session_token']);       
    }

    private function createOrder(){
        $products = $this->getCartProducts();    

        $order = [
            'session_token' => request()->session()->token(),
            'products' => $products,
            'billig_address' => null,
            'shipping_address' => null,
            'payment_method' => null,
            'shipping_method' => null,
        ];

        request()->session()->put('order', $order);

        // $this->clearCart();
    }

    private function getCartProducts(){
        return Cart::where('session_token', request()->session()->token())->first()->products;        
    }

    private function clearCart() {
        $cart = Cart::where('session_token', request()->session()->token())->first();
        $cart->products()->delete();
        $cart->delete();
        
    }
}
