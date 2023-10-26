<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MethodController extends Controller
{
    public function index($name)
    {
        return view('method.index', [
            'name' => $name
        ]);
    }   
}
