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
            'password' => 'required|string|min:6|confirmed',
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

            do {
                $numeroCompte = 'COMPTE-' . strtoupper(Str::random(10));
            } while (Compte::where('numero', $numeroCompte)->exists());

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

        return redirect('/')->with('success', 'Compte créé avec succès. Vous pouvez vous connecter.');
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
            'prenoms' => $user->prenoms
        ]);

        switch ($user->type) {
            case 'admin':
                return redirect('/administrateur')->route('administrateur.dashboard');

            case 'agent':
                return redirect('/agent');

            case 'client':
                return redirect('/client');

            default:
                Auth::logout();
                return back()->with('error', 'Type d\'utilisateur non reconnu.');
        }
    }

    public function showAdminDashboard()
    {
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
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Déconnexion réussie.');
    }

    public function yann()
    {
        return view('ajout-admin');
    }

    public function listeAgents()
    {
        $agents = Agent::with('user')->get();
        return view('liste-agent', compact('agents'));
    }

    public function editAgent($id)
    {
        $agent = Agent::with('user')->findOrFail($id);
        return view('edit-agent', compact('agent'));
    }

    public function updateAgent(Request $request, $id)
    {
        $soldeNettoye = str_replace(' ', '', $request->input('solde'));
        $request->merge(['solde' => $soldeNettoye]);

        $request->validate([
            'nom' => 'required|string',
            'prenoms' => 'required|string',
            'email' => 'required|email',
            'contact' => 'required|string',
            'code' => 'required|string',
            'solde' => 'required|numeric|min:0',
        ]);

        $agent = Agent::findOrFail($id);
        $user = $agent->user;

        $user->update([
            'nom' => $request->nom,
            'prenoms' => $request->prenoms,
            'email' => $request->email,
            'contact' => $request->contact,
        ]);

        $agent->update([
            'code' => $request->code,
            'solde' => $request->solde,
        ]);

        return redirect()->route('utilisateurs.liste')->with('success', 'Agent mis à jour avec succès.');
    }

    public function deleteAgent($id)
    {
        $agent = Agent::findOrFail($id);
        $agent->user()->delete();
        $agent->delete();

        return redirect()->route('utilisateurs.liste')->with('success', 'Agent supprimé avec succès.');
    }

    public function listeUtilisateurs(Request $request)
    {
        $filtre = $request->query('filtre', 'tous');

        $agents = Agent::with('user')->get();
        $admins = Administrateur::with('user')->get();

        return view('liste-agent', compact('agents', 'admins', 'filtre'));
    }

    public function showLoginForm()
    {
        return view('connexion');
    }
}
