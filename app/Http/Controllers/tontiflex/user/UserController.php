<?php

namespace App\Http\Controllers\tontiflex\user;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdateRequest;
use App\Services\UserServices;

class UserController extends Controller
{

    private $userServices;

    public function __construct(UserServices $userService)
    {
        $this->userServices = $userService;
    }

    public function index()
    {
        return redirect()->route('account-settings-account');
    }

    public function update(UpdateRequest $request, $id)
    {
        $this->userServices->updateUser($request, $id);

        return $this->userServices->updateUser($request, $id);;
    }
}
