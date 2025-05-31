<?php
namespace App\Repositories\interfaces;

use App\Http\Requests\WalletRequest;

interface WalletRepositoryInterfaces{
    public function getUserWallets();
    public function store(WalletRequest $walletRequest);
    public function showWallet($id);
    public function updateWallet(WalletRequest $request, $id);
    public function deleteWallet($id);

}