<?php

namespace App\Http\Controllers\tontiflex\wallettontine;

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
        return redirect()->route('tontine-view-main')->with('success', 'portefeuille créé avec succès.');
    }

    public function show($id)
    {
        $walletTontine = $this->walletTontineServices->showWalletTontine($id);
        return view('wallet_tontine.show', compact('walletTontine'));
    }

    public function store(WalletTontineRequest $request)
    {
        $this->walletTontineServices->store($request);
        return redirect()->route('tontine-view-main', $request->tontine_id)->with('success', 'portefeuille créé avec succès.');
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
