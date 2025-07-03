<?php

namespace App\Services;

use App\Repositories\interfaces\PaiementRepositoryInterfaces;
use Illuminate\Support\Facades\Auth;

class PaiementServices
{
    private $paiementRepository;

    public function __construct(PaiementRepositoryInterfaces $paiementRepository)
    {
        $this->paiementRepository = $paiementRepository;
    }

    public function getPaiements($id)
    {
        return $this->paiementRepository->getPaiements($id);
    }
    public function getAllPaiements()
    {
        return $this->paiementRepository->getAllPaiements();
    }
    public function proceedPaiement(array $data) {
        return $this->paiementRepository->proceedPaiement($data);
    }
    
    public function showPaiement($id) {
                return $this->paiementRepository->showPaiement($id);

    }
    
}
