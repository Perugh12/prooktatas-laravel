<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    public function index($username)
    {
        return "Hello, $username!";
    }

    public function list()
    {
        return 'List of users';
    }

    public function show($id)
    {
        return "User with ID $id";
    }

    public function store()
    {
        return 'User created';
    }

    public function update($id)
    {
        return "User with ID $id updated";
    }

    public function delete($id)
    {
        return "User with ID $id deleted";
    }

    public function datatable(?int $limit = null)
    {
        return "Showing $limit users";
    }

    public function addProcess(Request $request): JsonResponse
    {
        # json reponse
        return response()->json([
            'status' => 'success',
            'message' => 'User added successfully'
        ]);
    }
}
