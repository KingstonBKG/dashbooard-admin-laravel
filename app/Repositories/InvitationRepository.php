<?php

namespace App\Repositories;

use App\Http\Requests\InvitationRequest;
use App\Models\Invitation;
use App\Models\Tontine;
use App\Repositories\interfaces\InvitationRepositoryInterfaces;
use Illuminate\Support\Facades\Auth;

class InvitationRepository implements InvitationRepositoryInterfaces
{
    public function getAllInvitations()
    {
        return Invitation::with('expediteur', 'tontine')->where('destinataire_email', '=', Auth::user()->email)->get();
    }

    public function getInvitationById($id)
    {
        return Invitation::with('tontine')->findOrFail($id);
    }

    public function createInvitation(array $data)
    {
        return Invitation::create($data);
    }

    public function deleteInvitation($id)
    {
        $invitation = Invitation::findOrFail($id);
        Invitation::destroy($id);

        $invitation->refuser();
        return response()->json(['message' => 'Invitation supprimée']);
    }

    public function refuseInvitation($id)
    {
        $invitation = Invitation::findOrFail($id);
        $invitation->refuser();
        return response()->json(['message' => 'Invitation refusée']);
    }

    public function getInvitationstats($InvitationId)
    {
        return null;
    }
}
