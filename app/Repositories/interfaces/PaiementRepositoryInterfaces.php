<?php
namespace App\Repositories\interfaces;

use App\Http\Requests\PaiementRequest;
use App\Http\Requests\WalletRequest;

interface PaiementRepositoryInterfaces{
    public function getPaiements();
    public function proceedPaiement(PaiementRequest $paiementrequest);
    public function showPaiement($id);
}