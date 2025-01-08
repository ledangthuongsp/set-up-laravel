<?php
namespace App\Http\Controllers;

use App\Http\DTOs\Request\UserRequest;
use App\Models\User;

class UserController extends Controller
{
    public function store(UserRequest $request)
    {
        // Validate và tạo user
        $validated = $request->validated();
        User::create($validated);
        return response()->json(['message' => 'User created successfully!']);
    }
}
