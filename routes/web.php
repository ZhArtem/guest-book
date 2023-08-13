<?php

use App\Http\Controllers\GuestbookController;
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

Route::get('/', [GuestbookController::class, 'index'])->name('guestbook.index');
Route::post('/store', [GuestbookController::class, 'store'])->name('guestbook.store');

Route::get('/admin', [GuestbookController::class, 'admin'])->middleware('auth')->name('guestbook.admin'); // посредник не пропустит неавторизованного пользователя
Route::get('/admin/edit/{id}', [GuestbookController::class, 'adminEdit'])->middleware('auth')->name('admin.edit');
Route::post('/admin/update/{id}', [GuestbookController::class, 'adminUpdate'])->middleware('auth')->name('admin.update');
Route::post('/admin/delete', [GuestbookController::class, 'adminDelete'])->middleware('auth')->name('admin.delete');

Route::get('/edit/{id}', [GuestbookController::class, 'edit'])->name('guestbook.edit');
Route::post('/update/{id}', [GuestbookController::class, 'update'])->name('guestbook.update');
Route::post('/delete', [GuestbookController::class, 'delete'])->name('guestbook.delete');

Route::get('/login', [GuestbookController::class, 'login'])->name('login');
