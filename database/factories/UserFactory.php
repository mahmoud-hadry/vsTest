<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    // The name of the corresponding model
    protected $model = User::class;

    public function definition()
    {
        // Available timezones
        $timezones = ['CET', 'CST', 'GMT+1'];

        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'timezone' => $this->faker->randomElement($timezones),
            'email_verified_at' => now(),
            'password' => bcrypt('password'), // You can customize the password as per your needs
            'remember_token' => Str::random(10),
            'attributes_changed' =>true
        ];
    }
}
