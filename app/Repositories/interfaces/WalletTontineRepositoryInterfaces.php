<?php
namespace App\Repositories\interfaces;

use App\Http\Requests\WalletTontineRequest;

interface WalletTontineRepositoryInterfaces{
    public function getWalletTontines($tontine_id);
    public function store(WalletTontineRequest $WalletTontineRequest);
    public function showWalletTontine($id);
    public function updateWalletTontine(WalletTontineRequest $request, $id);
    public function deleteWalletTontine($id);

}