<?php

namespace App\Http\Controllers;

class CollectionController extends Controller
{
    public function index()
    {
        $collection = collect([1, 2, 3, 4, 5, 6, 7, 8, 9, 10]);

        $firstTask = $collection->sort()->implode(', ');

        $filtered = $collection->filter(function (int $value) {
            return $value % 2 == 0;
        });

        $secondTask = $filtered->implode(', ');

        $thirdTask = $collection->count();

        $newCollection = $collection->map(function (int $value) {
            return $value * 2;
        });
        $fourthTask = $newCollection->implode(', ');

        $fifthTask = $collection->shift();

        $collection->contains('x');
        $sixthTask = $collection->implode(', ');

        $seventhTask = $collection->merge($newCollection)->implode(', ');

        $eighthTask = $firstTask;

        $ninthTask = $collection->pop();

        $condition = $collection->filter(function (int $value) {
            return $value > 5;
        });

        $tenthTask = $condition->implode(', ');

        return view('index', [
            'first_task' => $firstTask,
            'second_task' => $secondTask,
            'third_task' => $thirdTask,
            'fourth_task' => $fourthTask,
            'fifth_task' => $fifthTask,
            'sixth_task' => $sixthTask,
            'seventh_task' => $seventhTask,
            'eighth_task' => $eighthTask,
            'ninth_task' => $ninthTask,
            'tenth_task' => $tenthTask
        ]);
    }
}
