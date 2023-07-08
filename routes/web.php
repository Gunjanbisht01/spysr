<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;

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


Route::match(['get', 'post'], '/contact', [ContactController::class, 'contact'])->name('save_contact');
Route::get('/', [ContactController::class, 'show'])->name('show');
Route::get('show_details/{id}', [ContactController::class, 'view'])->name('view');