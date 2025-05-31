<?php

namespace App\Http\Controllers\tontiflex\invitation;

use App\Http\Controllers\Controller;
use App\Http\Requests\InvitationRequest;
use App\Models\Tontine;
use App\Services\InvitationServices;

class InvitationController extends Controller
{

    private $invitationServices;

    public function __construct(InvitationServices $InvitationServicesService)
    {
        $this->invitationServices = $InvitationServicesService;
    }


    public function index()
    {
        return view('pages.dashboard.invitations.dashboard-invitations');
    }

    public function invitations()
    {
        $invitations = $this->invitationServices->getAllInvitations();

        return view('pages.dashboard.invitations.index-invitations', compact('invitations'));
    }

    public function store(InvitationRequest $invitationRequest, $id)
    {
        $data = $invitationRequest->validated();

        $this->invitationServices->createInvitation($data);

        return redirect()->route('tontines-tontines')
            ->with('success', 'Invitation envoyée avec succès');
    }

    public function refuse($id){
        $this->invitationServices->refuseInvitation($id);

        return redirect()->route('invitations-mes-invitations');
    }
}
