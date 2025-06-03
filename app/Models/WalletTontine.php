<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WalletTontine extends Model
{
    use HasFactory;

    protected $fillable = [
        'tontine_id',
        'montant',
        'type',
        'devise',
        'is_active'
    ];

    public function tontine()
    {
        return $this->belongsTo(Tontine::class);
    }
}
