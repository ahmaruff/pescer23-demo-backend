<?php

use App\Http\Controllers\BookController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::get('/', function() {
    return response()->json([
        'app_name' => 'Pescer CRUD Book',
        'description' => 'simple CRUD app for backend Demonstration',
        'laravel_version' => app()->version(),
    ]);
});

Route::resource('books', BookController::class)->except(['create', 'edit']);
