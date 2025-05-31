<?php

namespace App\Services;

use App\Http\Requests\UpdateNotificationPermissionRequest;
use App\Http\Requests\User\PermissionRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Models\User;
use App\Repositories\interfaces\UserRepositoryInterfaces;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserServices
{
    private $userRepository;

    public function __construct(UserRepositoryInterfaces $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function registerUser(array $data)
    {
        $data['password'] = Hash::make($data['password']);
        return $this->userRepository->createUser($data);
    }

    public function loginUser(string $email, string $password)
    {
        $user = $this->userRepository->getUserByEmail($email);

        if (!$user || !Hash::check($password, $user->password)) {
            return null;
        }

        return $user;
    }

    public function logout(Request $request)
    {
        $user = $request->user();
        $this->userRepository->logout($user);

        Auth::logout();

        return response()->json([
            'message' => 'Déconnexion réussie'
        ]);
    }

    public function getUser()
    {
        $currentUser = Auth::user();

        return $currentUser;
    }

    public function updateUser(UpdateRequest $updateRequest, $id)
    {
        $this->userRepository->updateUser($updateRequest, $id);

        return redirect()->route('account-settings-account');
    }

    public function updateNotificationAuthorization(PermissionRequest $updateRequest, $id)
    {
        $this->userRepository->updateNotificationAuthorization($updateRequest, $id);
        
        return redirect()->route('account-settings-account');
    }
}
