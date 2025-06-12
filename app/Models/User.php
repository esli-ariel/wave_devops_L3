<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'nom',
        'prenoms',
        'email',
        'contact',
        'password',
        'type',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function client()
    {
        return $this->hasOne(Client::class, 'id');
    }

public function agent()
{
    return $this->hasOne(Agent::class, 'id', 'id');
}

    public function administrateur()
    {
        return $this->hasOne(Administrateur::class, 'id');
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
