<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

use App\Models\User;
use App\Models\Client;
use App\Models\Compte;
use App\Models\Agent;
use App\Models\Administrateur;
use App\Models\Transaction;

class UserController extends Controller
{
    public function store(Request $request)
    {
        // Validation
        $validator = Validator::make($request->all(), [
            'nom' => 'required|string',
            'prenoms' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'contact' => 'required|string|unique:users,contact',
            'password' => 'required|string|min:6',
            'type' => 'required|in:client,agent,admin',
            'code' => 'required_if:type,agent|unique:agents,code',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Création de l'utilisateur
        $user = User::create([
            'nom' => $request->nom,
            'prenoms' => $request->prenoms,
            'email' => $request->email,
            'contact' => $request->contact,
            'password' => Hash::make($request->password),
            'type' => $request->type,
        ]);

        // Gestion selon le type
        if ($request->type === 'client') {
            $client = Client::create(['id' => $user->id]);

            // Génération du numéro de compte unique
            do {
                $numeroCompte = 'COMPTE-' . strtoupper(Str::random(10));
            } while (Compte::where('numero', $numeroCompte)->exists());

            // Création du compte
            Compte::create([
                'numero' => $numeroCompte,
                'solde' => 0,
                'statut' => 'actif',
                'client_id' => $client->id,
            ]);

        } elseif ($request->type === 'agent') {
            Agent::create([
                'id' => $user->id,
                'code' => $request->code,
                'solde' => 0,
            ]);

        } elseif ($request->type === 'admin') {
            Administrateur::create(['id' => $user->id]);
        }

        return redirect ('/administrateur');
    }

    public function login(Request $request)
    {
        $request->validate([
            'contact' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = User::where('contact', $request->contact)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->with('error', 'Contact ou mot de passe incorrect.');
        }

        Auth::login($user);

        // Stocker les infos dans la session
        session([
            'nom' => $user->nom,
            'prenoms' => $user->prenoms
        ]);

        // Redirection selon le type
        switch ($user->type) {
            case 'admin':
                $nbClient = Client::count();
                $nbAgents = Agent::count();
                $nbAdmins = Administrateur::count();
                $nbTransactions = Transaction::count();

                $dataChart = [
                    $nbClient,
                    $nbAgents,
                    $nbAdmins,
                    $nbTransactions,
                ];

                return view('administrateur', compact('nbClient', 'nbAgents', 'nbAdmins', 'nbTransactions', 'dataChart'));

            case 'agent':
                return redirect('/agent');

            case 'client':
                return redirect('/client');

            default:
                Auth::logout();
                return back()->with('error', 'Type d\'utilisateur non reconnu.');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout(); // Déconnexion de l'utilisateur

        $request->session()->invalidate(); // Invalide la session
        $request->session()->regenerateToken(); // Regénère le token CSRF

        return redirect('/connexion')->with('success', 'Déconnexion réussie.');
    }

    public function yann(){
        return view('ajout-admin');
    }



    public function listeAgents()
{
    // Récupérer les agents avec leurs informations utilisateur
    $agents = Agent::with('user')->get();

    return view('liste-agent', compact('agents'));

}


}
