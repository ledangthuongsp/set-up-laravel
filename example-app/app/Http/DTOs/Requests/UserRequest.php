<?php 
namespace App\Http\DTOs\Request;
use Illuminate\Foundation\Http\FormRequest;
class UserRequest extends FormRequest {
    public function authorize():bool{
        return true;
    }
   public function rules():array{
    return [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email|max:255', // Đảm bảo email không trùng
        'password' => 'required|string|min:8', // Đảm bảo password không null và đủ dài
    ];
   }
   public function messages(): array
    {
        return [
            'name.required' => 'The name is required.',
            'email.required' => 'The email is required.',
            'email.unique' => 'The email has already been taken.',
            'password.required' => 'The password is required.',
        ];
    }
}