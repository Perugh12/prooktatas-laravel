<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class ExampleController extends Controller
{
    private $list = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];

     public function index()
    {
        return view('example.index',[
            'page' => 'cart',
            'list' => implode(', ', $this->list),
            'title' => 'Lista elemei'
        ]);
    }  

    function add(Request $request) {
        $this->list[] = $request->item;       
        return response()->json([
            'list' => implode(', ', $this->list),
            'msg' => 'Elem sikeresen hozzáadva'
        ]);
    }

    function update(Request $request) {
        $item = $this->list[$request->key];
        $this->list[$request->key] = $request->item;
        return response()->json([
            'list' => implode(', ', $this->list),        
            'msg' => "Elem sikeresen frissítve. ($item -> $request->item)"
        ]);
    }

    function remove(Request $request) {
        if (!isset($this->list[$request->id])) {
            return response()->json([
                'list' => implode(', ', $this->list),                   
                'msg' => "Elem nem található. ($request->id)"
            ]);
        }

        $item = $this->list[$request->id];
        unset($this->list[$request->id]);

        return response()->json([
            'list' => implode(', ', $this->list),                   
            'msg' => "Elem sikeresen törölve. ($item)"
        ]);
    }
}
