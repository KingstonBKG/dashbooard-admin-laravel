<?php
namespace App\Repositories\interfaces;

use App\Http\Requests\PaiementRequest;
use App\Http\Requests\WalletRequest;

interface PaiementRepositoryInterfaces{
    public function getPaiements($tontine_id);
    public function proceedPaiement(array $data);
    public function showPaiement($id);
}