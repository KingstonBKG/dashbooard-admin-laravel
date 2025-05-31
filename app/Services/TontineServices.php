<?php

namespace App\Services;

use App\Models\Tontine;
use App\Repositories\interfaces\TontineRepositoryInterfaces;
use Illuminate\Support\Facades\Auth;

class TontineServices
{
    private $tontineRepository;

    public function __construct(TontineRepositoryInterfaces $tontineRepository)
    {
        $this->tontineRepository = $tontineRepository;
    }

    public function getAllTontines()
    {
        return $this->tontineRepository->getAllTontines();
    }

    public function getUserTontines()
    {
        return $this->tontineRepository->getUserTontines(Auth::id());
    }

    public function createTontine(array $data)
    {
        return $this->tontineRepository->createTontine($data);
    }

    public function getTontineDetails($id)
    {
        $tontine = $this->tontineRepository->getTontineById($id);
        $stats = $this->tontineRepository->getTontineStats($id);
        return [
            'tontine' => $tontine,
            'stats' => $stats
        ];
    }

    public function updateTontine($id, array $data)
    {
        return $this->tontineRepository->updateTontine($id, $data);
    }

    public function deleteTontine($id)
    {
        return $this->tontineRepository->deleteTontine($id);
    }

    public function addMember($tontineId, $userId, $invitationId)
    {
        return $this->tontineRepository->addMemberToTontine($tontineId, $userId, $invitationId);
    }

    public function removeMember($tontineId, $userId)
    {
        return $this->tontineRepository->removeMemberFromTontine($tontineId, $userId);
    }

    public function getTontineStats($tontineId)
    {
        return $this->tontineRepository->getTontineStats($tontineId);
    }

    public function getArchivedTontines()
    {
        $archived = Tontine::onlyTrashed()->get();

        return $archived;
    }

    public function restoreTontine($id)
    {
        return  $this->tontineRepository->restoreTontine($id);
       
    }

    public function deletePermanentlyTontine($id)
    {
        return  $this->tontineRepository->deletePermanentlyTontine($id);
       
    }
}
