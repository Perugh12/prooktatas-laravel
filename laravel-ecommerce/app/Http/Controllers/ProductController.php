<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function list()
    {
        // Ki lehet vele logolni a lekérdezéseket
        // \DB::enableQueryLog();
        // dd(\DB::getQueryLog());

        # Adatbázis lekérés, lekéri a termékeket
        $products = Product::where('stock', '>', 0)->get();

        return view('public.product.list', [
            'products' => $products
        ]);
    }
}
