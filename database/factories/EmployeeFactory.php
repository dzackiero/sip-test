<?php

namespace Database\Factories;

use App\Enums\Position;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_number' => fake()->unique()->randomNumber(8),
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'phone_number' => fake()->phoneNumber(),

            'position' => collect(Position::cases())->random()->value,
            'birth_date' => fake()->date(),
            'email' => fake()->unique()->safeEmail(),
            'province' => fake()->city(),
            'city' => fake()->city(),
            'street' => fake()->streetAddress(),
            'zip_code' => fake()->postcode(),
        ];
    }
}
