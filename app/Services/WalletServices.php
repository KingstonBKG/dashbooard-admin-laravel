<?php

namespace App\Services;

use App\Http\Requests\WalletRequest;
use App\Repositories\interfaces\UserRepositoryInterfaces;
use App\Repositories\interfaces\WalletRepositoryInterfaces;

class WalletServices
{
    private $walletRepository;

    public function __construct(WalletRepositoryInterfaces $walletRepositoryInterfaces)
    {
        $this->walletRepository = $walletRepositoryInterfaces;
    }

    public function getUserWallets()
    {
        return $this->walletRepository->getUserWallets();
    }

    public function showWallet($id)
    {
        return $this->walletRepository->showWallet($id);
    }


    public function updateWallet(WalletRequest $walletRequest, $id)
    {
        return $this->walletRepository->updateWallet($walletRequest, $id);
    }


}
