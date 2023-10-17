<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function index()
    {
        return view('wishlist.index', [
            'page' => 'wishlist'
        ]);
    }

    public function count()
    {
        return response()->json([
            'count' => 0
        ]);
    }

    public function add(Request $request)
    {
        return response()->json([
            'status' => 'success',
            'message' => 'Termék hozzáadva a kosárhoz'
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
