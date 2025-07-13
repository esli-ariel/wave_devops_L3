<?php

// use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\TransactionController;



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

Route::get('/info', function () {
    return view('welcome');
});

Route::get('/login', [UserController::class, 'showLoginForm'])->name('login.form');


Route::get('/', [AuthController::class, 'A']);
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


Route::get('/agent/send-money', [AgentController::class, 'showSendMoneyForm'])->name('agent.showSendMoneyForm');
Route::post('/agent/send-money', [AgentController::class, 'sendMoney'])->name('agent.sendMoney');



Route::get('/client/transfert', [TransactionController::class, 'showTransferForm'])->name('client.transfer.form');
Route::post('/client/transfert', [TransactionController::class, 'transfer'])->name('client.transfer');



Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');
Route::get('/transactions/pdf', [TransactionController::class, 'exportPdf'])->name('transactions.pdf');



use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

Route::get('/run-migrations', function () {
    if (request('token') !== env('MIGRATION_TOKEN')) {
        abort(403);
    }

    Artisan::call('migrate', ['--force' => true]);
    return 'Migrations exécutées.';
});

