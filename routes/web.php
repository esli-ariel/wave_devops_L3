<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;



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

Route::get('/', function () {
    return view('welcome');
});



Route::get('/connexion', [AuthController::class, 'A']);
Route::get('/inscription', [AuthController::class, 'B']);

Route::get('/administrateur', [AuthController::class, 'C']);


Route::get('/agent', [AuthController::class, 'D']);
Route::get('/depot', [AuthController::class, 'E']);

Route::get('/client', [AuthController::class, 'F']);

Route::get('/ajout-contact', [AuthController::class, 'G']);

Route::get('/contact', [AuthController::class, 'H']);




Route::post('/users', [UserController::class, 'store']);



Route::post('/login', [UserController::class, 'login']);


Route::get('/logout', [UserController::class, 'logout']);


Route::get('/ajout/admin', [UserController::class, 'yann']);



// Route::get('/liste-agents', [UserController::class, 'listeAgents']);



Route::get('/liste-agents', [UserController::class, 'listeAgents']);

