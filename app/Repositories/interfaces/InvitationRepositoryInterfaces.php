<?php

namespace App\Repositories\interfaces;

use App\Http\Requests\InvitationRequest;
use App\Models\Tontine;
use App\Models\User;

interface InvitationRepositoryInterfaces
{
    public function getAllInvitations();
    public function getInvitationById($id);
    public function createInvitation(array $data);
    public function deleteInvitation($id);
    public function refuseInvitation($id);
    public function getInvitationstats($InvitationId);
    
}
