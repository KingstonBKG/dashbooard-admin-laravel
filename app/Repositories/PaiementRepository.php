<?php

namespace App\Repositories;

use App\Http\Requests\InvitationRequest;
use App\Http\Requests\PaiementRequest;
use App\Models\Invitation;
use App\Repositories\interfaces\PaiementRepositoryInterfaces;
use Illuminate\Support\Facades\Auth;

class PaiementRepository implements PaiementRepositoryInterfaces
{
     public function getPaiements(){

     }
    public function proceedPaiement(PaiementRequest $paiementrequest){

    }
    public function showPaiement($id){
        
    }
}
