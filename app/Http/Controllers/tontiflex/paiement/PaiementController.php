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

    public function withdraw($id)
    {
        $data = $this->tontineServices->getTontineDetails($id);
        $tontine = $data['tontine'];
        $membres = $tontine->membres;
        return view('pages.paiement.withdraw-view', compact('membres'));
    }

    public function repartir($id)
    {
        $tontinewallets = $this->walletTontineServices->getWalletTontines($id);
        return view('pages.paiement.repartir-view', compact('tontinewallets'));
    }
    public function repartirproceed(Request $request)
    {

        $de = $request->de;
        $vers = $request->vers;
        $tontine_id = $request->tontine_id;
        $montant = $request->montant;

        $walletTontineprevious = WalletTontine::where('tontine_id', $tontine_id)->where('type', $de)->first();
        $walletTontinenext = WalletTontine::where('tontine_id', $tontine_id)->where('type', $vers)->first();

        if ($walletTontineprevious->montant < $montant) {
            return back()->withErrors(['wallet' => 'Solde du portefeuille débité insuffisant']);
        }

        if ($de != $vers && $montant >= 1000) {
            $walletTontineprevious->montant -= $montant;
            $walletTontinenext->montant += $montant;
        } else {
            return back()->withErrors(['wallet' => 'le portefeuille de depart doit etre different de celui d\'arriver et le montant <=1000fcfa']);
        }

        $walletTontineprevious->save();
        $walletTontinenext->save();

        return redirect()->route('tontine-view-main', $tontine_id)
            ->with('success', 'paiement reussi');
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
