<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => $this->faker->password,
            'phone' => $this->faker->phoneNumber,
            'batch' => $this->faker->year,
            'type' => $this->faker->randomElement(['postgraduate', 'undergraduate']),
            'department' => $this->faker->randomElement(['CSE', 'EEE', 'BBA', 'MBA', 'English']),
            'semester' => $this->faker->randomElement(['1st', '2nd', '3rd', '4th', '5th', '6th', '7th', '8th']),
            'roll' => $this->faker->randomNumber(5),
            'image' => $this->faker->imageUrl(640, 480, 'people'),
            'status' => $this->faker->randomElement([true, false]),
        ];
    }
}
