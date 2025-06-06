<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tontine>
 */
class TontineFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $contribution_frequency = ['hebdo', 'monthly', 'yearly', 'weekly', 'bi_weekly'];
        $type = ['fixed', 'rotating', 'voting'];
        $admin_id = [1,2,3,4,5,6];

        return [
            'name' => fake()->domainName(),
            'contribution_amount' => fake()->randomFloat(0, 1000, 100000),
            'contribution_frequency' => $this->faker->randomElement($contribution_frequency),
            'type' => $this->faker->randomElement($type),
            'description' => fake()->text(),
            'startDate' => fake()->dateTime(),
            'admin_id' => $this->faker->randomElement($admin_id),
            'status' => 'active',
            'max_members' => 20,
        ];


        
    }
}
