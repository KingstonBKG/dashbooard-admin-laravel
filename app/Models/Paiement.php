<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    use HasFactory;

    protected $fillable = [
        'moyen',
        'statut',
        'montant',
        'user_id',
        'tontine_id',
        'destinataire_id',
        'type'
    ];

    public function tontine()
    {
        return $this->belongsTo(Tontine::class);
    }
    public function utilisateur()
    {
    return $this->belongsTo(User::class, 'user_id');
    }
}
