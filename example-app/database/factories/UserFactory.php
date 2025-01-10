<?php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use PharIo\Manifest\Email;


class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(), // Đảm bảo name không null
            'email' => fake()->unique()->safeEmail(), // Đảm bảo email không trùng
            'email_verified_at' => now(), // Email đã được xác nhận
            'password' => Hash::make('password'), // Đảm bảo password có độ bảo mật cao
            'remember_token' => Str::random(10), // Tạo token ngẫu nhiên cho nhớ người dùng
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null, // Đặt email chưa xác nhận
        ]);
    }
}