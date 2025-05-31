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
}
