<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Client;
use App\Models\Compte;
use App\Models\Agent;
use App\Models\Administrateur;
use App\Models\Transaction;
class AuthController extends Controller
{

    public function A (){
        return view('connexion');
    }


    public function B (){
        return view('inscription');
    }

public function C(Request $request)
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

    session([
        'nom' => $user->nom,
        'prenoms' => $user->prenoms,
    ]);

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
            $agent = Agent::find($user->id);
            $solde = $agent?->solde ?? 0;

            $transactions = Transaction::where('user_id', $user->id)
                            ->orderBy('created_at', 'desc')
                            ->get();

            $nbTransactions = $transactions->count();

            return view('agent', compact('solde', 'transactions', 'nbTransactions'));

        case 'client':
            $client = Client::find($user->id);
            $compte = $client?->compte;
            $solde = $compte?->solde ?? 0;

            $transactions = Transaction::where('user_id', $user->id)
                            ->orderBy('created_at', 'desc')
                            ->get();

            $nbTransactions = $transactions->count();

            return view('client', compact('solde', 'transactions', 'nbTransactions'));

        default:
            Auth::logout();
            return back()->with('error', 'Type d\'utilisateur non reconnu.');
    }
}


public function D()
{
    $user = Auth::user();

    if (!$user || $user->type !== 'agent') {
        return redirect('/connexion')->with('error', 'Accès non autorisé.');
    }

    $agent = Agent::find($user->id);
    $solde = $agent ? $agent->solde : 0;

    $transactions = Transaction::where('user_id', $user->id)
                    ->with('beneficiaire.compte') // Charge le bénéficiaire + son compte
                    ->orderBy('created_at', 'desc')
                    ->get();

    $nbTransactions = $transactions->count();

    return view('agent', compact('solde', 'transactions', 'nbTransactions'));
}



    public function E (){
        return view('depot');
    }

public function F()
{
    $user = Auth::user();

    if (!$user || $user->type !== 'client') {
        return redirect('/connexion')->with('error', 'Accès non autorisé.');
    }

    $client = Client::find($user->id);
    $compte = $client?->compte;
    $solde = $compte?->solde ?? 0;

    // Récupérer la collection de transactions
    $transactions = Transaction::where('user_id', $user->id)
                    ->orderBy('created_at', 'desc')
                    ->get();

    // dd($transactions); // pour debug

    return view('client', compact('solde', 'transactions'));
}




    public function G (){
        return view('ajout-contact');
    }

    public function H (){
        return view('contact');
    }

    //
}
