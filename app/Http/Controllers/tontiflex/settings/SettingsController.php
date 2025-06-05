<?php

namespace App\Http\Controllers\tontiflex\settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\PermissionRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Services\UserServices;
use App\Services\WalletServices;

class SettingsController extends Controller
{

    private $userServices;
    private $walletServices;


    public function __construct(UserServices $userService, WalletServices $walletServices)
    {
        $this->userServices = $userService;
        $this->walletServices = $walletServices;
    }


    public function account()
    {
        $user = $this->userServices->getUser();
        return view('pages.account.pages-account-settings-account', compact('user'));
    }


    public function update(UpdateRequest $request, $id)
    {
        $this->userServices->updateUser($request, $id);
        return $this->userServices->updateUser($request, $id);;
    }

    public function updatenotificationauthorization(PermissionRequest $request, $id)
    {
        $this->userServices->updateNotificationAuthorization($request, $id);
        return $this->userServices->updateNotificationAuthorization($request, $id);
    }

    public function notification()
    {
        $user = $this->userServices->getUser();
        return view('pages.account.pages-account-settings-notifications', compact('user'));
    }

    public function connection()
    {
        return view('pages.account.pages-account-settings-connections');
    }

    public function wallet()
    {
        $wallets = $this->walletServices->getUserWallets();
        return view('pages.account.page-account-settings-wallet', compact('wallets'));
    }

    public function walletupdate(\Illuminate\Http\Request $request, $id)
    {
        $request->validate([
            'montant' => 'required|numeric|min:1000',
            'action' => 'required|in:deposit,withdraw',
        ]);

        $wallet = \App\Models\Wallet::findOrFail($id);

        if ($request->action === 'deposit') {
            $wallet->montant += $request->montant;
        } elseif ($request->action === 'withdraw') {
            if ($wallet->montant < $request->montant) {
                return back()->withErrors(['montant' => 'Solde insuffisant pour le retrait.']);
            }
            $wallet->montant -= $request->montant;
        }

        $wallet->save();

        return back()->with('success', 'Opération réalisée avec succès.');
    }
}
