<?php

namespace App\Services;

use App\Http\Requests\WalletTontineRequest;
use App\Repositories\interfaces\WalletTontineRepositoryInterfaces;

class WalletTontineServices
{
    private $walletTontineRepository;

    public function __construct(WalletTontineRepositoryInterfaces $walletTontineRepository)
    {
        $this->walletTontineRepository = $walletTontineRepository;
    }

    public function getWalletTontines($tontine_id)
    {
        return $this->walletTontineRepository->getWalletTontines($tontine_id);
    }

    public function showWalletTontine($id)
    {
        return $this->walletTontineRepository->showWalletTontine($id);
    }

    public function store(WalletTontineRequest $request)
    {
        return $this->walletTontineRepository->store($request);
    }

    public function updateWalletTontine(WalletTontineRequest $request, $id)
    {
        return $this->walletTontineRepository->updateWalletTontine($request, $id);
    }

    public function deleteWalletTontine($id)
    {
        return $this->walletTontineRepository->deleteWalletTontine($id);
    }
}