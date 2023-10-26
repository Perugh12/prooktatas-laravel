<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ValidationController extends Controller
{
    public function index()
    {
        return view('validation.index');
    }

    public function form(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email'],
            'password' => ['required', 'min:8']
        ]);

        if($validator->fails()){
            return redirect()->route('validation.index')->withErrors($validator);            
        }

        return redirect()->route('validation.index')->with('success', 'Sikeres validáció!');
    }
}
