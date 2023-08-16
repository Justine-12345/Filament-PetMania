<?php

use App\Http\Controllers\AnimalController;
use App\Http\Controllers\UserController;
use App\Http\Livewire\Register;
use App\Models\Animal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


Route::get('/', function (Request $request) {
    $animals = Animal::where('adoption_status', '=', 'Unadopted')
        ->where('is_healthy', '=', '1')
        ->limit(3)
        ->get();


    return view('welcome', ['animals' => $animals])->with('status', $request->session()->get('status'));
})->name('home');

Route::resource('animal', AnimalController::class);
Route::resource('user', UserController::class);

Route::get('/register', [UserController::class, 'getRegister'])->name('getRegister');
Route::post('/register', [UserController::class, 'register'])->name('register');

Route::get('/login', [UserController::class, 'getLogin'])->name('getLogin');
Route::post('/login', [UserController::class, 'login'])->name('login');

Route::get('/logout', [UserController::class, 'logout'])->name('logout');


Route::get('/profile', [UserController::class,'profile'])->name('getProfile');
Route::post('/profile', [UserController::class,'profileUpdate'])->name('profile');

Route::get('/password', [UserController::class,'getUpdatePassword'])->name('getPassword');
Route::post('/password', [UserController::class,'updatePassword'])->name('password');