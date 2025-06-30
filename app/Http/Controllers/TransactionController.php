<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;  // <-- Pour générer un UUID ou string aléatoire
use App\Models\User;
use App\Models\Client;
use App\Models\Compte;
use App\Models\Transaction;
use Barryvdh\DomPDF\Facade\Pdf;

class TransactionController extends Controller
{
    public function transfer(Request $request)
    {
        $request->validate([
            'recipient_contact' => 'required|string',
            'amount' => 'required|numeric|min:1',
        ]);

        $senderUser = Auth::user();

        if (!$senderUser || $senderUser->type !== 'client') {
            return redirect('/connexion')->with('error', 'Accès non autorisé.');
        }

        // Récupérer le client expéditeur
        $sender = Client::find($senderUser->id);
        if (!$sender || !$sender->compte) {
            return back()->with('error', 'Compte expéditeur introuvable.');
        }

        $senderCompte = $sender->compte;

        // Rechercher le destinataire dans users par contact
        $recipientUser = User::where('contact', $request->recipient_contact)->first();
        if (!$recipientUser) {
            return back()->with('error', 'Le destinataire n\'existe pas.');
        }

        // Récupérer le client lié au destinataire
        $recipient = Client::find($recipientUser->id);
        if (!$recipient || !$recipient->compte) {
            return back()->with('error', 'Le destinataire ou son compte n\'existe pas.');
        }

        if ($recipient->id === $sender->id) {
            return back()->with('error', 'Vous ne pouvez pas vous envoyer de l\'argent à vous-même.');
        }

        if ($senderCompte->solde < $request->amount) {
            return back()->with('error', 'Solde insuffisant.');
        }

        // Exécution du transfert
        try {
            // Débit expéditeur
            $senderCompte->solde -= $request->amount;
            $senderCompte->save();

            // Crédit destinataire
            $recipientCompte = $recipient->compte;
            $recipientCompte->solde += $request->amount;
            $recipientCompte->save();

            // Enregistrement des transactions avec numéro unique
            Transaction::create([
                'user_id' => $sender->id,
                'type' => 'transfert',
                'montant' => $request->amount,
                'numero' => 'TXN-' . strtoupper(Str::random(10)),
            ]);

            Transaction::create([
                'user_id' => $recipient->id,
                'type' => 'reception',
                'montant' => $request->amount,
                'numero' => 'TXN-' . strtoupper(Str::random(10)),
            ]);

            return redirect('/client')->with('success', 'Transfert effectué avec succès.');

        } catch (\Exception $e) {
            return back()->with('error', 'Une erreur est survenue : ' . $e->getMessage());
        }
    }

    public function showTransferForm()
    {
        $user = Auth::user();

        if (!$user || $user->type !== 'client') {
            return redirect('/connexion')->with('error', 'Accès non autorisé.');
        }

        return view('transfert'); // nom de ta vue pour le formulaire
    }

    public function index()
{
    // Récupère toutes les transactions avec les relations utiles
    $transactions = Transaction::with('user') // si tu veux l'utilisateur lié
                        ->orderBy('created_at', 'desc')
                        ->get();

    return view('index', compact('transactions'));
}

public function exportPdf()
{
    $transactions = Transaction::with('user')->orderBy('created_at', 'desc')->get();
    $pdf = Pdf::loadView('pdf', compact('transactions'));
    return $pdf->download('historique_transactions.pdf');
}

}
