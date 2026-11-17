
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LeaveRequestController;

Route::get('/', function () {
    return redirect()->route('leave-requests.index');
});

// Guest routes: users who are not logged in
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

// Authenticated routes: logged-in employees
Route::middleware('auth')->group(function () {
    Route::resource('leave-requests', LeaveRequestController::class);

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
