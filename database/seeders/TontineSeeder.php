<?php

namespace Database\Seeders;

use App\Models\Tontine;
use App\Models\WalletTontine;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TontineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tontines = Tontine::factory()->count(20)->create();

        foreach ($tontines as $tontine) {
            // Ajoute l'admin comme membre avec le rôle 'admin' dans la table pivot
            $tontine->membres()->attach($tontine->admin_id, ['role' => 'admin']);
            
            WalletTontine::create([
                'tontine_id' => $tontine->id,
                'montant' => 0,
                'type' => 'principal',
                'is_active' => true,
            ]);
        }
    }
}
