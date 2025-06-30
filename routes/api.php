<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\AuthController;

// Authentification
Route::post('/register', [UserController::class, 'store']); // Inscription
Route::post('/login', [UserController::class, 'C']);        // Connexion
Route::post('/logout', [UserController::class, 'logout']);  // Déconnexion

// === CLIENT ROUTES ===
Route::get('/client/solde', [AuthController::class, 'F']); // Voir solde client
Route::post('/client/transfert', [TransactionController::class, 'transfer']); // Transfert client → client
Route::get('/client/transactions', [TransactionController::class, 'index']);  // Historique client

// === AGENT ROUTES ===
Route::get('/agent/solde', [AuthController::class, 'D']); // Voir solde agent
Route::post('/agent/send-money', [AgentController::class, 'sendMoney']); // Transfert agent → client
Route::get('/agent/transactions', [TransactionController::class, 'index']); // Historique agent

// === ADMIN ROUTES ===
Route::get('/admin/dashboard', [UserController::class, 'C']); // Dashboard admin
Route::get('/admin/users', [UserController::class, 'listeUtilisateurs']); // Liste utilisateurs
Route::get('/admin/agents', [UserController::class, 'listeAgents']); // Liste agents
Route::get('/admin/transactions', [TransactionController::class, 'index']); // Historique complet
Route::get('/admin/transactions/pdf', [TransactionController::class, 'exportPdf']); // Export PDF
