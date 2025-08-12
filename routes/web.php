<?php

use App\Http\Controllers\AuthController;
use App\Livewire\CategoriLivewire;
use App\Livewire\DashboardLivewire;
use App\Livewire\ItemLivewire;
use App\Livewire\StaffLivewire;
use App\Livewire\WarehouseLivewire;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/login-waretrack', [AuthController::class, 'index'])->name('login')->middleware('guest');
Route::post('/auth-waretrack', [AuthController::class, 'authenticate'])->name('authenticate')->middleware('guest');
Route::get('/logout-waretrack', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::get('/', DashboardLivewire::class)->name('dashboard')->middleware('auth');
Route::get('/category', CategoriLivewire::class)->name('categori')->middleware('auth');
Route::get('/warehouse', WarehouseLivewire::class)->name('warehouse')->middleware('auth');
Route::get('/staff', StaffLivewire::class)->name('staff')->middleware('auth');
Route::get('/item', ItemLivewire::class)->name('item')->middleware('auth');
