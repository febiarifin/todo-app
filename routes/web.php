<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\TodoController;
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

Route::get('/', [HomeController::class, 'index']);

Route::get('/todo', [TodoController::class, 'index']);

Route::post('/addTodo', [TodoController::class, 'create']);

Route::get('/editTodo/{id}/{status}', [TodoController::class, 'update']);

Route::get('/cancelTodo/{id}/{status}', [TodoController::class, 'cancelTodo']);

Route::get('/detailTodo/{id}', [TodoController::class, 'detailTodo']);

Route::post('/editValueTodo', [TodoController::class, 'editValueTodo']);

Route::get('/deleteTodo/{id}', [TodoController::class, 'delete']);