<?php

namespace App\Repositories;

use App\Constants\Roles;
use App\Models\Invitation;
use App\Models\Tontine;
use App\Models\User;
use App\Repositories\interfaces\TontineRepositoryInterfaces;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TontineRepository implements TontineRepositoryInterfaces
{
    public function getAllTontines()
    {
        return Tontine::with(['admin', 'membres'])->get();
    }

    public function getTontineById($id)
    {
        return Tontine::with(['admin', 'membres'])->findOrFail($id);
    }

    public function createTontine(array $data)
    {

        $tontine = Tontine::create($data);
        $user = Auth::user();
        $this->assignRoleToMember($user, $tontine->id, 'admin');

        return $tontine;
    }

    public function updateTontine($id, array $data)
    {
        $tontine = $this->getTontineById($id);
        $tontine->update($data);
        return $tontine;
    }

    public function deleteTontine($id)
    {
        return Tontine::destroy($id);
    }

    public function getUserTontines($userId)
    {
        return Tontine::with(['admin', 'membres'])->where('admin_id', $userId)
            ->orWhereHas('membres', function ($query) use ($userId) {
                $query->where('users.id', $userId);
            })->get();
    }

    public function getActiveTontines()
    {
        return Tontine::where('status', 'active')->get();
    }

    public function getTontineStats($tontineId)
    {
        $tontine = $this->getTontineById($tontineId);
        return [
            'total_members' => $tontine->membres->count(),
            'current_pot' => $tontine->current_pot,
            'contribution_amount' => $tontine->contribution_amount,
            'total_contributions' => $tontine->current_pot,
            'remaining_spots' => $tontine->max_members - $tontine->membres->count()
        ];
    }

    public function addMemberToTontine($tontineId, $userId, $invitationId)
    {
        $invitation = Invitation::find($invitationId);

        $tontine = $this->getTontineById($tontineId);
        
        $invitation->accepter();

        return $tontine->membres()->attach($userId);
    }

    public function removeMemberFromTontine($tontineId, $userId)
    {
        $tontine = $this->getTontineById($tontineId);
        return $tontine->membres()->detach($userId);
    }

    public function getArchivedTontines($userId)
    {
        return Tontine::onlyTrashed()
            ->where('admin_id', $userId)
            ->orWhereHas('membres', function ($query) use ($userId) {
                $query->where('users.id', $userId);
            })->get();
    }

    public function restoreTontine($id)
    {
        return Tontine::withTrashed()->find($id)->restore();
    }

    public function deletePermanentlyTontine($id)
    {
        return Tontine::withTrashed()->find($id)->forceDelete();
    }

    public function assignRoleToMember(User $user, $id, $role)
    {
        $Tontine = Tontine::find($id);
        $user->assignRole($Tontine->id, $role);

        return Response()->json([
            "message" => "Rôle assigné avec succès"
        ]);
    }
}
