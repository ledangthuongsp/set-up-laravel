<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Xác định người dùng có quyền gửi request hay không.
     */
    public function authorize(): bool
    {
        return true; // Cho phép tất cả người dùng gửi request
    }

    /**
     * Định nghĩa các rule để validate dữ liệu.
     */
    public function rules(): array
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ];

        // Nếu là update (có ID truyền vào), bỏ qua email của chính user đó khi kiểm tra unique
        if ($this->method() === 'PUT' || $this->method() === 'PATCH') {
            $rules['email'] = 'required|email|unique:users,email,' . $this->route('id');
            $rules['password'] = 'nullable|string|min:8|confirmed';
        }

        return $rules;
    }
}
