<?php

namespace App\Http\Controllers\tontiflex\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\PaiementServices;
use App\Services\TontineServices;
use App\Services\WalletTontineServices;

class AnalyticsController extends Controller
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
        $paiments = $this->paiementServices->getAllPaiements();
         $tontine =        $this->tontineServices->getUserTontines();



        return view('pages.dashboard.analytics.dashboard-analytics', compact('paiments', 'tontine'));
    }
}
