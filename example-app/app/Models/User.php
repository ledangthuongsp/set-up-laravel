<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
        ];
    }

    /**
     * Perform validation for user registration.
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public static function validate(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'], // Validate email and ensure it's unique
            'password' => [
                'required',
                'min:8',  // Password must be at least 8 characters
                'regex:/[A-Za-z]/',  // Password must contain at least one letter
                'regex:/[0-9]/',  // Password must contain at least one number
                'regex:/[@$!%*?&]/',  // Password must contain at least one special character
                'regex:/[A-Z]/',  // Password must contain at least one uppercase letter
            ],
        ]);
    }

    /**
     * Set the user's password while hashing it.
     *
     * @param string $password
     * @return void
     */
    public function setPasswordAttribute($password)
    {
        // Hash the password before saving
        $this->attributes['password'] = Hash::make($password);
    }

    /**
     * Check if the provided password matches the user's password.
     *
     * @param string $password
     * @return bool
     */
    public function checkPassword($password)
    {
        return Hash::check($password, $this->password);
    }
}
