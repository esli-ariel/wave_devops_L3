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

Route::get('/login', [UserController::class, 'showLoginForm'])->name('login.form');


Route::get('/connexion', [AuthController::class, 'A']);
Route::get('/inscription', [AuthController::class, 'B']);

Route::get('/administrateur', [UserController::class, 'C']);


Route::get('/agent', [AuthController::class, 'D']);
Route::get('/depot', [AuthController::class, 'E']);

Route::get('/client', [AuthController::class, 'F']);

Route::get('/ajout-contact', [AuthController::class, 'G']);

Route::get('/contact', [AuthController::class, 'H']);




Route::post('/users', [UserController::class, 'store']);



Route::post('/login', [UserController::class, 'C']);


Route::get('/logout', [UserController::class, 'logout']);


Route::get('/ajout/admin', [UserController::class, 'yann']);



// Route::get('/liste-agents', [UserController::class, 'listeAgents']);



Route::get('/liste-agents', [UserController::class, 'listeAgents']);

// Modifier
Route::get('/modifier/agent/{id}', [UserController::class, 'editAgent'])->name('agent.edit');
Route::post('/modifier/agent/{id}', [UserController::class, 'updateAgent'])->name('agent.update');

// Supprimer
Route::delete('/supprimer/agent/{id}', [UserController::class, 'deleteAgent'])->name('agent.delete');


Route::get('/liste-utilisateurs', [UserController::class, 'listeUtilisateurs'])->name('utilisateurs.liste');
