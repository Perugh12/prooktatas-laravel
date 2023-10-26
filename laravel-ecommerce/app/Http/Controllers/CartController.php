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

        $product = Product::where('id', $request->product_id)->first();
        $product->stock = $product->stock - $request->quantity;
        $product->save();

        return response()->json([
            'status' => 'success',
            'message' => 'A termék kosárhoz adva'
        ]);
    }

    public function changeQuantity(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'cart_product_id' => ['required', 'integer', 'exists:cart_products,id'],
            'change' => ['required', 'string', 'in:increase,decrease,change'],
            'quantity' => ['required', 'integer']
        ], [
            'cart_product_id.required' => 'A termék azonosítója kötelező!',
            'cart_product_id.integer' => 'A termék azonosítója csak szám lehet!',
            'cart_product_id.exists' => 'A termék nem létezik!',
            'change.required' => 'A művelet kötelező!',
            'change.string' => 'A művelet csak szöveg lehet!',
            'change.in' => 'A művelet csak növelés vagy csökkentés lehet!',
            'quantity.required' => 'A mennyiség kötelező!',
            'quantity.integer' => 'A mennyiség csak szám lehet!'
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->first() 
            ]);
        }

        $cartProduct = CartProduct::whereHas('cart', function ($query) {
            $query->where('session_token', request()->session()->token());
        })->where('id', $request->cart_product_id)->first();

        if (!$cartProduct) {
            return response()->json([
                'status' => 'error',
                'message' => 'A termék nem található a kosárban'
            ]);
        }

        $oldQuantity = $cartProduct->quantity;

        if ($request->change == 'increase') {
            $newQuantity = $cartProduct->quantity + $request->quantity;
        }elseif($request->change == 'decrease') {            
            $newQuantity = $cartProduct->quantity - $request->quantity;            
        } elseif ($request->change == 'change') {
            $newQuantity = $request->quantity;
        }
       
        if ($newQuantity < 1) {
            return response()->json([
                'status' => 'error',
                'message' => 'A termék mennyisége nem lehet kevesebb, mint 1'
            ]);
        }

        if (($newQuantity - $oldQuantity) > $cartProduct->product->stock) {
            return response()->json([
                'status' => 'error',
                'message' => 'Maximum lefoglalható termék mennyisége: ' . $cartProduct->product->stock . ' db'
            ]);
        }

        # Növeli a termék mennyiségét
        $cartProduct->quantity = $newQuantity;
        $cartProduct->save();

        $product = Product::where('id', $cartProduct->product_id)->first();

        # Termék elemeinek módosítása adatbázisban
        if($oldQuantity > $newQuantity){        
            $product->stock = $product->stock + ($oldQuantity - $newQuantity);
        } else {            
            $product->stock = $product->stock - ($newQuantity - $oldQuantity);
        }        
        
        $product->save();

        return response()->json([
            'status' => 'success',
            'message' => 'A termék mennyisége sikeresen megváltozott',
            'new_quantity' => $newQuantity
        ]);
    }

    public function remove($id)
    {
        $validator = Validator::make(['id' => $id], [
            'id' => ['required', 'integer', 'exists:cart_products,id']
        ], [
            'id.required' => 'A termék azonosítója kötelező!',
            'id.integer' => 'A termék azonosítója csak szám lehet!',
            'id.exists' => 'A termék nem létezik!'
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->first() 
            ]);
        }

        $cartProduct = CartProduct::whereHas('cart', function ($query) {
            $query->where('session_token', request()->session()->token());
        })->where('id', $id)->first();

        if (!$cartProduct) {
            return response()->json([
                'status' => 'error',
                'message' => 'A termék nem található a kosárban'
            ]);
        }

        # Visszaajduk a készletnek a lefoglalt elemeket
        $product = Product::where('id', $cartProduct->product_id)->first();
        $product->stock = $product->stock + $cartProduct->quantity;
        $product->save();

        # Kosárból törli a terméket
        $cartProduct->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Termék törölve a kosárból'
        ]);
    }
}
