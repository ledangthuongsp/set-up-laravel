<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;

Route::get('/api/documentation', function () {
    // Lấy tài liệu từ cấu hình
    $documentation = config('l5-swagger.default.documentation', 'default');
    $urlToDocs = url('swagger/default'); // Bạn có thể thay đổi URL này nếu cần
    return view('l5-swagger::index', compact('documentation', 'urlToDocs')) ;
});

Route::get('/', [UserController::class, 'index'])->name('home');
Route::resource('user', UserController::class);
Route::get('/home', [UserController::class, 'index'])->name('home');
Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
Route::post('/user/store', [UserController::class, 'store'])->name('user.store');
Route::get('/user/{user}/edit', [UserController::class, 'edit'])->name('user.edit');
Route::put('/user/{user}', [UserController::class, 'update'])->name('user.update');
Route::delete('/user/{user}', [UserController::class, 'destroy'])->name('user.destroy');
Route::get('/user/{user}', [UserController::class, 'show'])->name('user.show');

Auth::routes();
