<?php
namespace App\Repositories\interfaces;

use App\Http\Requests\User\PermissionRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Models\User;

interface UserRepositoryInterfaces{
    public function createUser(array $data);
    public function getUserByEmail(string $email);

    public function updateUser(UpdateRequest $request, $id);
    public function updateNotificationAuthorization(PermissionRequest $request, $id);

    public function logout(User $user);
}