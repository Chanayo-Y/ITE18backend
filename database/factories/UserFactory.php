<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * Factory for generating fake users for seeding/testing.
 * Matches your custom users table schema.
 *
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{

    protected static ?string $password;

    public function definition(): array
    {
        return [
            'userID' => '231-' . str_pad(fake()->unique()->numberBetween(1, 99999), 5, '0', STR_PAD_LEFT),
            'f_name' => fake()->firstName(),
            'm_name' => fake()->optional()->firstName(),
            'l_name' => fake()->lastName(),
            'password' => static::$password ??= Hash::make('password'),
            'email' => fake()->unique()->safeEmail(),
            'gender' => fake()->randomElement(['M', 'F']),
            'address' => fake()->address(),
            'phoneNum' => fake()->numerify('09#########'),
            'roleID' => fake()->randomElement(['1', '2', '3']),
        ];
    }



    public function student(): static
    {
        return $this->state(fn (array $attributes) => [
            'roleID' => '3',
        ]);
    }

    public function employee(): static
    {
        return $this->state(fn (array $attributes) => [
            'roleID' => '2',
        ]);
    }

    public function admin(): static
    {
        return $this->state(fn (array $attributes) => [
            'roleID' => '1',
        ]);
    }
}
