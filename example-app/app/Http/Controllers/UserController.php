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

    // Cập nhật thông tin người dùng
    public function update(UserRequest $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8|confirmed', // Chỉ yêu cầu mật khẩu nếu người dùng thay đổi
        ]);

        $user = User::findOrFail($id); // Tìm người dùng theo ID
        
        // Nếu người dùng cung cấp mật khẩu mới, mã hóa nó, nếu không giữ nguyên mật khẩu cũ
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
        ]);

        return redirect()->route('user.show', $user->id); // Chuyển hướng về trang chi tiết người dùng sau khi cập nhật thành công
    }


    // Xóa người dùng
    public function destroy($id)
    {
        $user = User::findOrFail($id); // Lấy người dùng theo ID
        $user->delete(); // Xóa người dùng

        return redirect()->route('user.index'); // Chuyển hướng đến danh sách người dùng
    }
}
