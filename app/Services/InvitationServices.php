<?php

namespace App\Services;

use App\Http\Requests\InvitationRequest;
use App\Models\Tontine;
use App\Repositories\interfaces\InvitationRepositoryInterfaces;

class InvitationServices
{
    private $invitationRepository;

    public function __construct(InvitationRepositoryInterfaces $InvitationRepository)
    {
        $this->invitationRepository = $InvitationRepository;
    }

    public function getAllInvitations()
    {
        return $this->invitationRepository->getAllInvitations();
    }

    public function getInvitationById($id)
    {
        return $this->invitationRepository->getInvitationById($id);
    }

    public function createInvitation(array $data)
    {
        $invitation = $this->invitationRepository->createInvitation($data);
        return redirect()->route('invitations-dashboard', compact('invitation'));
    }

    public function deleteInvitation($id)
    {
        $Invitation = $this->invitationRepository->deleteInvitation($id);

        return $Invitation;
    }

        public function refuseInvitation($id)
    {
        $Invitation = $this->invitationRepository->refuseInvitation($id);

        return $Invitation;
    }

    public function getInvitationstats(){}
}
