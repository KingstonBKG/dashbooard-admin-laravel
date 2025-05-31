<?php

namespace App\Http\Controllers\tontiflex\wallet;

use App\Http\Controllers\Controller;
use App\Http\Requests\WalletRequest;
use App\Services\WalletServices;
use Illuminate\Http\Request;

class WalletController extends Controller
{
    private $walletServices;

    public function __construct(WalletServices $walletServices)
    {
        $this->walletServices = $walletServices;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $wallets = $this->walletServices->getUserWallets();

        return view('pages.account.page-account-settings-wallet', compact('wallets'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(WalletRequest $request)
    {
        $this->walletServices->store($request);
        $wallets = $this->walletServices->getUserWallets();

        return redirect()->route('account-settings-wallet', compact('wallets'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(WalletRequest $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->walletServices->deleteWallet($id);

        $wallets = $this->walletServices->getUserWallets();

        return redirect()->route('account-settings-wallet', compact('wallets'));
    }
}
