<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\DTOs\Request\UserRequest;


class ProfileController extends Controller
{
    /**
     * Hiển thị form chỉnh sửa profile.
     */
    public function edit()
    {
        $user = Auth::user(); // Lấy thông tin user đang đăng nhập
        return view('profile.edit', compact('user'));
    }

    /**
     * Cập nhật thông tin profile.
     */
    public function update(UserRequest $request, $id)
    {
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $id,
    ]);

    $user = User::findOrFail($id); // Lấy người dùng theo ID
    $user->update([
        'name' => $request->name,
        'email' => $request->email,
    ]);

    return redirect()->route('user.show', $user->id);
    }
}

