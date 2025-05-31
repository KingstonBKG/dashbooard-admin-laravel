<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    use HasFactory;

    protected $fillable = [
        'expediteur_id', 'destinataire_email', 'tontine_id', 'statut', 'date_invitation',
    ];

    public function expediteur()
    {
        return $this->belongsTo(User::class, 'expediteur_id');
    }

    public function accepter(){
        $this->statut = 'accepte';
        $this->save();
    }

    public function refuser(){
        $this->statut = 'refuse';
        $this->save();
    }

    public function tontine()
    {
        return $this->belongsTo(Tontine::class);
    }
}
