<?php

namespace App\Repositories;

use App\Http\Requests\InvitationRequest;
use App\Http\Requests\WalletRequest;
use App\Http\Requests\WalletTontineRequest;
use App\Models\Invitation;
use App\Models\Tontine;
use App\Models\WalletTontine;
use App\Repositories\interfaces\WalletTontineRepositoryInterfaces;
use Illuminate\Support\Facades\Auth;

class WalletTontineRepository implements WalletTontineRepositoryInterfaces
{
    public function getWalletTontines($tontine_id)
    {
        // Retourne tous les WalletTontine de l'utilisateur connecté (si besoin, adapte selon ta logique)
        return WalletTontine::with('tontine')->where('tontine_id', $tontine_id)->get();
    }

    public function showWalletTontine($id)
    {
        return WalletTontine::with('tontine')->findOrFail($id);
    }

    public function store(WalletTontineRequest $request)
    {
        return WalletTontine::create($request->validated());
    }

    public function updateWalletTontine(WalletTontineRequest $request, $id)
    {
        $walletTontine = WalletTontine::findOrFail($id);
        $walletTontine->update($request->validated());
        return $walletTontine;
    }

    public function deleteWalletTontine($id)
    {
        $walletTontine = WalletTontine::findOrFail($id);
        return $walletTontine->delete();
    }
}
