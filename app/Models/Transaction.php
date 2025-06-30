<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = ['numero', 'type', 'montant', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    // app/Models/Transaction.php

// public function client()
// {
//     return $this->belongsTo(Client::class, 'client_id');
// }
// app/Models/Transaction.php

public function beneficiaire()
{
    return $this->belongsTo(Client::class, 'client_id'); // ou 'beneficiaire_id' si c’est ce que tu utilises
}




}