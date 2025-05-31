<?php

namespace App\Repositories;

use App\Http\Requests\InvitationRequest;
use App\Http\Requests\WalletRequest;
use App\Models\Invitation;
use App\Repositories\interfaces\WalletRepositoryInterfaces;
use Illuminate\Support\Facades\Auth;

class WalletRepository implements WalletRepositoryInterfaces
{
    public function getUserWallets()
    {
        return Auth::user()->wallets;
    }

    public function showWallet($id)
    {
        return Auth::user()->wallets()->findOrFail($id);
    }

    public function store(WalletRequest $walletRequest)
    {
        return Auth::user()->wallets()->create($walletRequest->validated());
    }


    public function updateWallet(WalletRequest $walletRequest, $id)
    {
        $wallet = Auth::user()->wallets()->findOrFail($id);
        $wallet->update($walletRequest->validated());
        return  response()->json($wallet);
    }


    public function deleteWallet($id)
    {
        Auth::user()->wallets()->findOrFail($id)->delete();
        return response()->json(['message' => 'Wallet supprimé avec succès']);
    }
}
