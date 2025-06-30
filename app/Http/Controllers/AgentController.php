<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Client;
use App\Models\Compte;
use App\Models\Agent;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;

class AgentController extends Controller
{
    // Affiche le formulaire d'envoi d'argent
    public function showSendMoneyForm()
    {
        return view('agent_send_money');
    }

    // Traite l'envoi d'argent
    public function sendMoney(Request $request)
    {
        $request->validate([
            'client_contact' => 'required|string|exists:users,contact',
            'montant' => 'required|numeric|min:1',
        ]);

        $agentUser = Auth::user();

        // Vérifie que l'utilisateur est bien un agent
        if (!$agentUser || $agentUser->type !== 'agent') {
            return redirect()->route('agent.showSendMoneyForm')->withErrors('Accès non autorisé.');
        }

        // Trouver le client via le contact
        $clientUser = User::where('contact', $request->client_contact)->where('type', 'client')->first();

        if (!$clientUser) {
            return redirect()->route('agent.showSendMoneyForm')->withErrors('Client introuvable.');
        }

        $client = Client::find($clientUser->id);
        $compteClient = $client?->compte;

        if (!$compteClient) {
            return redirect()->route('agent.showSendMoneyForm')->withErrors('Compte client introuvable.');
        }

        $agent = Agent::find($agentUser->id);

        if (!$agent) {
            return redirect()->route('agent.showSendMoneyForm')->withErrors('Agent introuvable.');
        }

        $montant = $request->montant;

        // Optionnel : vérifier que l'agent a assez de solde pour envoyer
        if ($agent->solde < $montant) {
            return redirect()->route('agent.showSendMoneyForm')->withErrors('Solde insuffisant.');
        }

        DB::beginTransaction();

        try {
            // Débiter le solde de l'agent
            $agent->solde -= $montant;
            $agent->save();

            // Créditer le solde du client
            $compteClient->solde += $montant;
            $compteClient->save();

            // Créer la transaction pour l'agent (sortante)
            Transaction::create([
                'numero' => 'TXN-' . strtoupper(uniqid()),
                'type' => 'envoi',
                'montant' => $montant,
                'user_id' => $agentUser->id,
            ]);

            // Créer la transaction pour le client (entrée)
            Transaction::create([
                'numero' => 'TXN-' . strtoupper(uniqid()),
                'type' => 'reception',
                'montant' => $montant,
                'user_id' => $clientUser->id,
            ]);

            DB::commit();

            return redirect('/agent')->with('success', 'Argent envoyé avec succès.');

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('agent.showSendMoneyForm')->withErrors('Erreur lors de la transaction : ' . $e->getMessage());
        }
    }
}
