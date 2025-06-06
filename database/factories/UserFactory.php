<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    private $index = 0;
    private $indexemail = 0;

    private $usernames = ['kingstonBKG', 'edwinFom', 'womsRovanol', 'stesJasmine', 'presRyan', 'feunkBrunel'];
    private $emails = ['bakobogalbertlegrand@gmail.com', 'edwin@gmail.com', 'woms@gmail.com', 'stes@gmail.com', 'pres@gmail.com', 'feunk@gmail.com'];


    public function definition(): array
    {

        $username = $this->usernames[$this->index];
        $this->index = ($this->index + 1) % count($this->usernames);

        $email = $this->emails[$this->indexemail];
        $this->indexemail = ($this->indexemail + 1) % count($this->emails);

        return [
            'username' => $username,
            'email' => $email,
            'organization' => fake()->company(),
            'phoneNumber' => fake()->phoneNumber(),
            'address' => fake()->address(),
            'country' => fake()->country(),
            'language' => fake()->languageCode(),
            'timeZones' => fake()->timezone(),
            'currency' => fake()->currencyCode(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
