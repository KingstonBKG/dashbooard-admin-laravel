<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Wallet;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::factory()->count(6)->create();

        foreach($users as $user){
            Wallet::create([
            'user_id' => $user->id,
            'montant' => 0,
            'type' => 'solde principal',
            'is_active' => true,
        ]);
        }
    }
}
