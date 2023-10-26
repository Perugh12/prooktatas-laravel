<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function index()
    {
        if (!$this->issetOrder()) {
            $this->createOrder();
        }
        
        return view('order.index', [
            'page' => 'order',        
        ]);
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
        $cart->delete();
        
        $cart->delete();    
        
    }

    public function order(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'billig_first_name' => ['required', 'string', 'max:255'],
            'billig_last_name' => ['required', 'string', 'max:255'],
            'billig_phone' => ['required', 'string', 'max:255'],
            'billig_email' => ['required', 'string', 'max:255'],
            'billig_company' => ['string', 'max:255'],
            'billig_country' => ['required', 'string', 'max:255'],
            'billig_state' => ['required', 'string', 'max:255'],
            'billig_zipcode' => ['required', 'string', 'max:255'],
            'billig_city' => ['required', 'string', 'max:255'],
            'billig_street_name' => ['required', 'string', 'max:255'],
            'billig_street_type' => ['required', 'string', 'max:255'],
            'billig_house_number' => ['required', 'string', 'max:255'],
            'billig_building_number' => ['string', 'max:255'],
            'billig_floor_number' => ['string', 'max:255'],
            'billig_apartment_number' => ['string', 'max:255'],
            'shipment_method' => ['required', 'string', 'max:255'],
            'shipment_first_name' => ['required', 'string', 'max:255'],
            'shipment_last_name' => ['required', 'string', 'max:255'],
            'shipment_phone' => ['required', 'string', 'max:255'],
            'shipment_email' => ['required', 'string', 'max:255'],
            'shipment_company' => ['string', 'max:255'],
            'shipment_country' => ['required', 'string', 'max:255'],
            'shipment_state' => ['required', 'string', 'max:255'],
            'shipment_zipcode' => ['required', 'string', 'max:255'],
            'shipment_city' => ['required', 'string', 'max:255'],
            'shipment_street_name' => ['required', 'string', 'max:255'],
            'shipment_street_type' => ['required', 'string', 'max:255'],
            'shipment_house_number' => ['required', 'string', 'max:255'],
            'shipment_building_number' => ['string', 'max:255'],
            'shipment_floor_number' => ['string', 'max:255'],
            'shipment_apartment_number' => ['string', 'max:255'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $order = request()->session()->get('order');
        $order['order'] = request()->all();
        request()->session()->put('order', $order);
    }
}
