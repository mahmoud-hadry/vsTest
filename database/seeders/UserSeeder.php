<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Seed 20 users with random timezones
        User::factory()->count(20)->create();
    }
}
