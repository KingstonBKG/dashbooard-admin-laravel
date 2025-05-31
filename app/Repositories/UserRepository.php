<?php

namespace App\Repositories;

use App\Http\Requests\User\PermissionRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Models\User;
use App\Notifications\UpdateRequestNotification;
use App\Repositories\interfaces\UserRepositoryInterfaces;
use Illuminate\Support\Facades\Auth;

class UserRepository implements UserRepositoryInterfaces
{
    public function createUser(array $data)
    {
        return User::create($data);
    }


    public function getUserByEmail(string $email)
    {
        return User::where('email', $email)->first();
    }

    public function updateUser(UpdateRequest $updateRequest, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->route('pages-account-settings-account')->with('error', 'Utilisateur non trouvé');
        }

        $data = $updateRequest->validated();

        $photoUrl = $updateRequest->validated('image');

        if ($photoUrl != null && !$photoUrl->getError()) {
            $data['image'] = $photoUrl->store('users', 'public');
        }

        if(!empty($data['password'])){
            $data['password'] = bcrypt($data['password']);
        }else{
            unset($data['password']);
        }

        $user->update($data);

        $user->notify(new UpdateRequestNotification($user));


        return redirect()->route('pages-account-settings-account')->with('success', 'Mise à jour effectuée');
    }

    public function updateNotificationAuthorization(PermissionRequest $updateRequest, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->route('pages-account-settings-notifications')->with('error', 'Utilisateur non trouvé');
        }

        
        $data['authorize_notification'] = $updateRequest->validated(['authorize_notification']);

        $user->update($data);

        return redirect()->route('pages-account-settings-notifications')->with('success', 'Mise à jour effectuée');
    }
    public function logout(User $user)
    {
        $user->tokens()->delete();
    }
}
