<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\RoomTypeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\CashRegisterController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ReportController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index']);
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Password Reset Routes
Route::get('/password/reset', [AuthController::class, 'showForgotPasswordForm'])->name('password.request');
Route::post('/password/email', [AuthController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/password/reset/{token}', [AuthController::class, 'showResetForm'])->name('password.reset');
Route::post('/password/reset', [AuthController::class, 'reset'])->name('password.update');

// User Profile Routes
Route::get('/profile', [UserController::class, 'profile'])->name('profile');
Route::get('/profile/public/{id}', [UserController::class, 'publicProfile'])->name('profile.public');
Route::put('/profile', [UserController::class, 'updateProfile'])->name('profile.update');
Route::put('/profile/password', [UserController::class, 'updatePassword'])->name('profile.password');

// Roles and Permissions
Route::get('/roles', function () {
    return view('users.roles');
})->name('roles');

// Chat
Route::get('/chat', [ChatController::class, 'index'])->name('chat');

// Notifications
Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications');

// Search
Route::get('/search', [SearchController::class, 'index'])->name('search');
Route::get('/search/results', [SearchController::class, 'search'])->name('search.results');

// Reports
Route::get('/reports', [ReportController::class, 'index'])->name('reports');
Route::get('/reports/occupancy', [ReportController::class, 'occupancy'])->name('reports.occupancy');
Route::get('/reports/financial', [ReportController::class, 'financial'])->name('reports.financial');
Route::get('/reports/guest', [ReportController::class, 'guest'])->name('reports.guest');
Route::post('/reports/export', [ReportController::class, 'export'])->name('reports.export');

Route::resource('hotels', HotelController::class);
Route::resource('rooms', RoomController::class);
Route::resource('guests', GuestController::class);
Route::resource('reservations', ReservationController::class);
Route::resource('services', ServiceController::class);
Route::resource('room-types', RoomTypeController::class);
Route::resource('employees', EmployeeController::class);
Route::resource('cash-registers', CashRegisterController::class);
Route::resource('transactions', TransactionController::class);
Route::resource('invoices', InvoiceController::class);
Route::resource('users', UserController::class);