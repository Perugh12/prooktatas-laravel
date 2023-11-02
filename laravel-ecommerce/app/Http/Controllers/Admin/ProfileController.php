<?php 

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ProfileController extends BaseController 
{
    public function show(): JsonResponse
    {
        if (!auth()->user()) {
            return $this->sendError('You must be logged in to get your profile', [], 401);
        }

        $user = User::select('id', 'name', 'email')->find(auth()->user()->id);

        return $this->sendResponse($user, 'User profile retrieved successfully.');
    }

    public function update(Request $request): JsonResponse
    {
        if (!auth()->user()) {
            return $this->sendError('You must be logged in to update your profile', [], 401);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|min:3',
            'email' => 'required|email|unique:users,email,' . auth()->user()->id,
            'password' => 'nullable|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors(), 422);
        }       

        $user = User::find(auth()->user()->id);
        $user->name = $request->name;

        if($user->email != $request->email) {
            $user->email = $request->email;
        }

        $user->password = $request->password ? Hash::make($request->password) : $user->password;
        $user->save();
        
         return $this->sendResponse($user, 'User updated successfully.');
    }

    public function delete(Request $request): JsonResponse
    {
        if (!auth()->user()) {
            return $this->sendError('You must be logged in to get your profile', [], 401);
        }

        $user = User::find(auth()->user()->id);

        # Soft delete miatt csak kap egy dátuom de nem véglegesen lett törölve
        $user->delete();

        return $this->sendResponse([], 'User deleted successfully.');
    }
}
