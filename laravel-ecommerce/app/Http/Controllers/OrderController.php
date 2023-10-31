<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Mail\OrderMail;
use App\Models\Product;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function index()
    {
        if (!$this->issetOrder()) {
            $this->createOrder();
        }

        $test = [
            'payment_address' => [
                'firstname' => 'John',
                'lastname' => 'Doe',
                'phone' => '123456789',
                'email' => 'perugh12@gmail.com',
                'company' => 'Test Company',
                'country' => 'Hungary',
                'state' => 'Budapest',
                'zipcode' => '1234',
                'city' => 'Budapest',
                'street_name' => 'Test Street',
                'street_type' => 'Street',
                'house_number' => '1',
                'building_number' => '1',
                'floor_number' => '1',
                'apartment_number' => '1',
            ],
            'shipping_address' => [
                'firstname' => 'John',
                'lastname' => 'Doe',
                'phone' => '123456789',
                'email' => 'perugh12@gmail.com',
                'company' => 'Test Company',
                'country' => 'Hungary',
                'state' => 'Budapest',
                'zipcode' => '1234',
                'city' => 'Budapest',
                'street_name' => 'Test Street',
                'street_type' => 'Street',
                'house_number' => '1',
                'building_number' => '1',
                'floor_number' => '1',
                'apartment_number' => '1',
            ],
        ];

        return view('order.index', [
            'page' => 'order',
            'test' => $test,
        ]);
    }

    public function billingAddressStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'max:255'],
            'company' => ['string', 'max:255'],
            'country' => ['required', 'string', 'max:255'],
            'state' => ['required', 'string', 'max:255'],
            'zipcode' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'street_name' => ['required', 'string', 'max:255'],
            'street_type' => ['required', 'string', 'max:255'],
            'house_number' => ['required', 'string', 'max:255'],
            'building_number' => ['string', 'max:255'],
            'floor_number' => ['string', 'max:255'],
            'apartment_number' => ['string', 'max:255'],
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $order = request()->session()->get('order');
        $order['billing_address'] = request()->only([
            'firstname',
            'lastname',
            'phone',
            'email',
            'company',
            'country',
            'state',
            'zipcode',
            'city',
            'street_name',
            'street_type',
            'house_number',
            'building_number',
            'floor_number',
            'apartment_number',
        ]);
        request()->session()->put('order', $order);

        return response()->json([
            'success' => 'success',
            'session' => request()->session()->get('order'),
        ], 200);
    }
    public function shippingAddressStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'max:255'],
            'company' => ['string', 'max:255'],
            'country' => ['required', 'string', 'max:255'],
            'state' => ['required', 'string', 'max:255'],
            'zipcode' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'street_name' => ['required', 'string', 'max:255'],
            'street_type' => ['required', 'string', 'max:255'],
            'house_number' => ['required', 'string', 'max:255'],
            'building_number' => ['string', 'max:255'],
            'floor_number' => ['string', 'max:255'],
            'apartment_number' => ['string', 'max:255'],
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $order = request()->session()->get('order');
        $order['shipping_address'] = request()->only([
            'firstname',
            'lastname',
            'phone',
            'email',
            'company',
            'country',
            'state',
            'zipcode',
            'city',
            'street_name',
            'street_type',
            'house_number',
            'building_number',
            'floor_number',
            'apartment_number',
        ]);
        request()->session()->put('order', $order);

        return response()->json([
            'success' => 'success',
            'session' => request()->session()->get('order'),
        ], 200);
    }
    public function paymentMethodStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'payment_method' => ['required', 'string', 'max:255', 'in:transfer,cash'],
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $order = request()->session()->get('order');
        $order['payment_method'] = request()->only(['payment_method']);
        request()->session()->put('order', $order);

        return response()->json([
            'success' => 'success',
            'session' => request()->session()->get('order'),
        ], 200);
    }
    public function shipmentMethodStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'shipment_method' => ['required', 'string', 'max:255', 'in:delivery,pickup'],
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $order = request()->session()->get('order');
        $order['shipment_method'] = request()->only(['shipment_method']);
        request()->session()->put('order', $order);

        return response()->json([
            'success' => 'success',
            'session' => request()->session()->get('order'),
        ], 200);
    }

    public function summary()
    {
        $order = request()->session()->get('order');

        if (empty($order['billing_address']) || empty($order['shipping_address']) || empty($order['payment_method']) || empty($order['shipment_method'])) {
            return response()->json([
                'errors' => 'Missing Data',
            ], 422);
        }
        return response()->json([
            'order' => $order,
        ], 200);
    }

    public function products()
    {
        $products = request()->session()->get('order')['products'];
        return response()->json([
            'products' => $products,
        ], 200);
    }

    public function store()
    {
        $orderSession = request()->session()->get('order');

        if (empty($orderSession['billing_address']) || empty($orderSession['shipping_address']) || empty($orderSession['payment_method']) || empty($orderSession['shipment_method'])) {
            return response()->json([
                'errors' => 'Missing Data',
            ], 422);
        }

        $user_id = null;

        if (auth()->check()) {
            $user_id = auth()->user()->id;
        }

        $orderDB = Order::create([
            'user_id' => $user_id,
            'status' => 'pedding',
            'payment_method' => $orderSession['payment_method']['payment_method'],
            'shipping_method' => $orderSession['shipment_method']['shipment_method'],
            'payment_firstname' => $orderSession['billing_address']['firstname'],
            'payment_lastname' => $orderSession['billing_address']['lastname'],
            'payment_phone' => $orderSession['billing_address']['phone'],
            'payment_email' => $orderSession['billing_address']['email'],
            'payment_company' => $orderSession['billing_address']['company'],
            'payment_country' => $orderSession['billing_address']['country'],
            'payment_state' => $orderSession['billing_address']['state'],
            'payment_zipcode' => $orderSession['billing_address']['zipcode'],
            'payment_city' => $orderSession['billing_address']['city'],
            'payment_street_name' => $orderSession['billing_address']['street_name'],
            'payment_street_type' => $orderSession['billing_address']['street_type'],
            'payment_house_number' => $orderSession['billing_address']['house_number'],
            'payment_building_number' => $orderSession['billing_address']['building_number'],
            'payment_floor_number' => $orderSession['billing_address']['floor_number'],
            'payment_apartment_number' => $orderSession['billing_address']['apartment_number'],
            'shipping_firstname' => $orderSession['shipping_address']['firstname'],
            'shipping_lastname' => $orderSession['shipping_address']['lastname'],
            'shipping_phone' => $orderSession['shipping_address']['phone'],
            'shipping_email' => $orderSession['shipping_address']['email'],
            'shipping_company' => $orderSession['shipping_address']['company'],
            'shipping_country' => $orderSession['shipping_address']['country'],
            'shipping_state' => $orderSession['shipping_address']['state'],
            'shipping_zipcode' => $orderSession['shipping_address']['zipcode'],
            'shipping_city' => $orderSession['shipping_address']['city'],
            'shipping_street_name' => $orderSession['shipping_address']['street_name'],
            'shipping_street_type' => $orderSession['shipping_address']['street_type'],
            'shipping_house_number' => $orderSession['shipping_address']['house_number'],
            'shipping_building_number' => $orderSession['shipping_address']['building_number'],
            'shipping_floor_number' => $orderSession['shipping_address']['floor_number'],
            'shipping_apartment_number' => $orderSession['shipping_address']['apartment_number']
        ]);

        if (!$orderDB) {
            return response()->json([
                'errors' => 'Order not created',
            ], 422);
        }

        foreach ($orderSession['products'] as $product) {
            $orderProduct = OrderProduct::create([
                'order_id' => $orderDB->id,
                'product_id' => $product['product_id'],
                'quantity' => $product['quantity'],
                'unit_price' => $product['unit_price'],
            ]);

            if (!$orderProduct) {
                return response()->json([
                    'errors' => 'Order not created',
                ], 422);
            }
        }

        # Email küldés

        return response()->json([
            'success' => 'success',
            'order_id' => $orderDB->id,
        ], 200);
    }

    public function end($id)
    {
        $order = Order::where('id', $id)->first();
        return view('order.end', [
            'order' => $order
        ]);
    }

    private function issetOrder()
    {
        return isset(request()->session()->get('order')['session_token']);
    }

    private function createOrder()
    {
        $products = $this->getCartProducts();

        $order = [
            'session_token' => request()->session()->token(),
            'products' => $products,
            'billing_address' => null,
            'shipping_address' => null,
            'payment_method' => null,
            'shipment_method' => null,
        ];

        request()->session()->put('order', $order);

        $this->clearCart();
    }

    private function getCartProducts()
    {
        return Cart::where('session_token', request()->session()->token())->first()->products;
    }

    private function clearCart()
    {
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
