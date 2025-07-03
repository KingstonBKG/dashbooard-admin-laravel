<?php

namespace App\Repositories;

use App\Http\Requests\InvitationRequest;
use App\Http\Requests\PaiementRequest;
use App\Models\Invitation;
use App\Models\Paiement;
use App\Repositories\interfaces\PaiementRepositoryInterfaces;
use Illuminate\Support\Facades\Auth;

class PaiementRepository implements PaiementRepositoryInterfaces
{
    public function getPaiements($tontine_id)
    {
        return Paiement::with(['tontine', 'utilisateur'])
            ->where('tontine_id', $tontine_id)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function getAllPaiements()
    {
        $paiement = Paiement::with(['tontine', 'utilisateur'])
            ->where('user_id', Auth::user()->id)
            ->where('type', 'deposit')
            ->orderBy('created_at', 'desc')
            ->get();
        $recus = Paiement::with(['tontine', 'utilisateur'])
            ->where('user_id', Auth::user()->id)
            ->where('type', 'withdraw')
            ->orderBy('created_at', 'desc')
            ->get();

        return [
            $paiement,
            $recus
        ];
    }

    public function proceedPaiement(array $data)
    {

        $paiement = Paiement::create($data);

        return response()->json($paiement, 201);
    }

    public function showPaiement($id)
    {
        return Paiement::with('utilisateur', 'tontine')->findOrFail($id);
    }
}
