<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\Order;

class OrderController extends Controller
{
    public function index(): JsonResponse
    {
        $orders = Order::all();

        return $this->sendResponse($orders, 'Orders retrieved successfully.');
    }
}
