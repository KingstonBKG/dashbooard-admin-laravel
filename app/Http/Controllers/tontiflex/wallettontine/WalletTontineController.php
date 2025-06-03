<?php

namespace App\Http\Controllers\tontiflex\walletTontineController;

use App\Http\Controllers\Controller;
use App\Http\Requests\WalletTontineRequest;
use App\Services\WalletTontineServices;

class WalletTontineController extends Controller
{
    protected $walletTontineServices;

    public function __construct(WalletTontineServices $walletTontineServices)
    {
        $this->walletTontineServices = $walletTontineServices;
    }

    public function index()
    {
        $walletTontines = $this->walletTontineServices->getWalletTontines();
        return view('wallet_tontine.index', compact('walletTontines'));
    }

    public function show($id)
    {
        $walletTontine = $this->walletTontineServices->showWalletTontine($id);
        return view('wallet_tontine.show', compact('walletTontine'));
    }

    public function create()
    {
        return view('wallet_tontine.create');
    }

    public function store(WalletTontineRequest $request)
    {
        $this->walletTontineServices->store($request);
        return redirect()->route('wallet-tontine.index')->with('success', 'WalletTontine créé avec succès.');
    }

    public function edit($id)
    {
        $walletTontine = $this->walletTontineServices->showWalletTontine($id);
        return view('wallet_tontine.edit', compact('walletTontine'));
    }

    public function update(WalletTontineRequest $request, $id)
    {
        $this->walletTontineServices->updateWalletTontine($request, $id);
        return redirect()->route('wallet-tontine.index')->with('success', 'WalletTontine modifié avec succès.');
    }

    public function destroy($id)
    {
        $this->walletTontineServices->deleteWalletTontine($id);
        return redirect()->route('wallet-tontine.index')->with('success', 'WalletTontine supprimé avec succès.');
    }
}
