<?php

namespace App\Repositories\interfaces;

use App\Models\User;

interface TontineRepositoryInterfaces
{
    public function getAllTontines();
    public function getTontineById($id);
    public function createTontine(array $data);
    public function updateTontine($id, array $data);
    public function deleteTontine($id);
    public function deletePermanentlyTontine($id);
    public function getUserTontines($userId);
    public function getActiveTontines();
    public function getTontineStats($tontineId);
    public function addMemberToTontine($tontineId, $userId, $invitationId);
    public function removeMemberFromTontine($tontineId, $userId);

    public function getArchivedTontines($userId);
    public function restoreTontine($id);
    public function assignRoleToMember(User $user, $id, $role);
    
}
