<?php

namespace App\Http\Controllers\tontiflex\paiement;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaiementRequest;
use App\Models\Paiement;
use App\Models\User;
use App\Models\WalletTontine;
use App\Services\PaiementServices;
use App\Services\TontineServices;
use App\Services\WalletTontineServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaiementController extends Controller
{

    private $paiementServices, $tontineServices, $walletTontineServices;

    public function __construct(PaiementServices $paiementServices, TontineServices $tontineServices, WalletTontineServices $walletTontineServices)
    {
        $this->paiementServices = $paiementServices;
        $this->tontineServices = $tontineServices;
        $this->walletTontineServices = $walletTontineServices;
    }

    public function index()
    {
        return view('pages.paiement.paiement-view');
    }

    public function withdraw()
    {
        $users = $this->tontineServices->getUserTontines()->first();
        $membres = $users['membres'];
        return view('pages.paiement.withdraw-view', compact('membres'));
    }

    public function store(PaiementRequest $paiementRequest, $id)
    {
        $dataform = $paiementRequest->validated();
        $type = $paiementRequest->type;

        // 1. Récupérer le wallet de la tontine sélectionnée
        $walletTontine = WalletTontine::where('tontine_id', $id)->first();

        if (!$walletTontine) {
            return back()->withErrors(['wallet' => 'Aucun wallet trouvé pour cette tontine.']);
        }

        $wallet = Auth::user()->wallets->first();


        if ($type === 'withdraw') {

            $destinataire = User::findOrFail($dataform['destinataire_id']);
            $walletdestinaire = $destinataire->wallets->first();

            if ($walletTontine->montant < $dataform['montant']) {
                return back()->withErrors(['montant' => 'Solde insuffisant pour le retrait.']);
            }

            $walletdestinaire->montant += $dataform['montant'];
            $walletTontine->montant -= $dataform['montant'];

            $walletdestinaire->save();
        } else {
            if ($wallet->montant < $dataform['montant']) {
                return back()->withErrors(['montant' => 'votre solde principal est insuffisant. Veuillez recharger. Solde actuel ' . $wallet->montant . ' FCFA']);
            }   
            $wallet->montant -= $dataform['montant'];
            $walletTontine->montant += $dataform['montant'];
            $wallet->save();
        }

        $walletTontine->save();

        // 3. Enregistrer le paiement
        $this->paiementServices->proceedPaiement($dataform);

        return redirect()->route('tontine-view-main', $id)
            ->with('success', 'paiement reussi');
    }

    public function show($id)
    {
        $data = $this->paiementServices->showPaiement($id);
        return response()->json($data, 201);
    }
}
