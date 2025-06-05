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

    public function updateWallet(WalletRequest $walletRequest, $id)
    {
        $wallet = Auth::user()->wallets()->findOrFail($id);
        $wallet->update($walletRequest->validated());
        return  response()->json($wallet);
    }
}
