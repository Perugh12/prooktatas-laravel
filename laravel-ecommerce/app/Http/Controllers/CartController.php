<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Cart;
use App\Models\CartProduct;
use App\Models\Product;

class CartController extends Controller
{
    public function index()
    {
        $cartProducts = CartProduct::whereHas('cart', function ($query) {
            $query->where('session_token', request()->session()->token());
        })->orderBy('created_at', 'desc')->get();

        $cartProducts->transform(function ($cartProduct) {
            $cartProduct->total_price = $cartProduct->totalPrice();
            return $cartProduct;
        });

        return view('cart.index', [
            'page' => 'cart',
            'cart_products' => $cartProducts
        ]);
    }

    public function count()
    {
        return response()->json([
            'count' => CartProduct::whereHas('cart', function($query){
                $query->where('session_token', request()->session()->token());
            })->count()
        ]);
    }

    public function add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => ['required', 'integer', 'exists:products,id'],
            'quantity' => ['required', 'integer', 'min:1']
        ], [
            'product_id.required' => 'A termék azonosítója kötelező!',
            'product_id.integer' => 'A termék azonosítója csak szám lehet!',
            'product_id.exists' => 'A termék nem létezik!',
            'quantity.required' => 'A mennyiség kötelező!',
            'quantity.integer' => 'A mennyiség csak szám lehet!',
            'quantity.min' => 'A mennyiség legalább 1 kell legyen!'
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->first() // lehet all is nem mindegy mennyit küld vissza, ha több elem van
            ]);
        }

        # Lecsekkolja és létrehozza, ha még nem létezik a kosár
        $cart = Cart::firstOrCreate([
            'session_token' => $request->session()->token()
        ]);

        # Lecsekkolja, hogy a termék már benne van-e a kosárban
        $cartProduct = CartProduct::where([
            'cart_id' => $cart->id,
            'product_id' => $request->product_id,
            'unit_price' => Product::where('id', $request->product_id)->first()->unitPrice()
        ])->first();

        # Ha már benne van a kosárban, akkor növeli a mennyiséget
        if($cartProduct){
            $cartProduct->quantity += $request->quantity;
            $cartProduct->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Termék frissítve a kosárban'
            ]);
        }

         $cartProduct = CartProduct::create([
            'cart_id' => $cart->id,
            'product_id' => $request->product_id,
            'unit_price' => Product::where('id', $request->product_id)->first()->unitPrice(),
            'quantity' => $request->quantity
        ])->first();

        if (!$cartProduct) {
            return response()->json([
                'status' => 'error',
                'message' => 'Hiba történt a kosrába helyezés során'
            ]);
        }      

        return response()->json([
            'status' => 'success',
            'message' => 'A termék kosárhoz adva'
        ]);
    }

    public function update(Request $request)
    {
        return response()->json([
            'status' => 'success',
            'message' => 'Termék frissítve a kosárban'
        ]);
    }

    public function remove($id)
    {
        return response()->json([
            'status' => 'success',
            'message' => 'Termék törölve a kosárból'
        ]);
    }
}
