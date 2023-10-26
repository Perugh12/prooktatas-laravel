<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExampleSessionController extends Controller
{
    public function index(){
        $user_id = session('user_id');
        return view('session.index', compact('user_id'));
    }
    
    public function set($id){
        session(['user_id' => $id]);
        return redirect()->route('session.index');
    }

    public function destroy(){
        session()->flush();
        return redirect()->route('session.index');
    }

    public function get($id){
        $alert = 'danger';
        $isset_user_id = $id;
        $msg = 'Nem létezik az ID: '.$id.'!';
        $user_id = session('user_id');

        if ($user_id == $id) {
            $isset_user_id = $user_id;
            $alert = 'success';
            $msg = 'Létezik az ID: '.$user_id.'!';
        }

        return view('session.index', [
            'isset_user_id' => $isset_user_id,
            'alert' => $alert,
            'msg' => $msg
        ]);
    }

    public function update($id){
        session(['user_id' => $id]);
        return redirect()->route('session.index');
    }
}
