<?php

namespace App\Http\Controllers;

use App\Http\DTOs\Request\UserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Hiển thị danh sách người dùng
    public function index()
    {
        $users = User::all(); // Lấy tất cả người dùng
        return view('user.index', compact('users')); // Trả về view danh sách người dùng
    }

    // Hiển thị form tạo người dùng mới
    public function create()
    {
        return view('user.create_new_user'); // Trả về view tạo người dùng mới
    }

    // Lưu thông tin người dùng mới
    public function store(UserRequest $request)
    {
        $validatedData = $request->validated(); // Xác thực dữ liệu theo UserRequest

        // Tạo người dùng mới
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']), // Mã hóa mật khẩu
        ]);

        return redirect()->route('user.show', $user->id); // Chuyển hướng đến trang chi tiết người dùng vừa tạo
    }

    // Hiển thị thông tin người dùng theo ID
    public function show($id)
    {
        $user = User::findOrFail($id); // Lấy người dùng theo ID
        return view('user.show', compact('user')); // Trả về view chi tiết người dùng
    }

    // Hiển thị form chỉnh sửa người dùng
    public function edit($id)
    {
        $user = User::findOrFail($id); // Lấy người dùng theo ID
        return view('user.edit_user', compact('user')); // Trả về view chỉnh sửa người dùng
    }

    // Cập nhật thông tin người dùng
    public function update(UserRequest $request, $id)
    {
        $validatedData = $request->validated(); // Xác thực dữ liệu theo UserRequest

        // Lấy người dùng theo ID
        $user = User::findOrFail($id);
        $user->update([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            // Nếu có mật khẩu mới, cập nhật mật khẩu
            'password' => $request->password ? Hash::make($validatedData['password']) : $user->password,
        ]);

        return redirect()->route('user.show', $user->id); // Chuyển hướng đến trang chi tiết người dùng
    }

    // Xóa người dùng
    public function destroy($id)
    {
        $user = User::findOrFail($id); // Lấy người dùng theo ID
        $user->delete(); // Xóa người dùng

        return redirect()->route('user.index'); // Chuyển hướng đến danh sách người dùng
    }
}
