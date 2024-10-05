<?php
namespace App\Console\Commands;

use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Console\Command;

class UpdateUserDetails extends Command
{
    // The name and signature of the console command.
    protected $signature = 'user:update-random-details';

    // The console command description.
    protected $description = 'Update users\' firstname, lastname, and timezone to random ones';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $faker = Faker::create();
        $timezones = ['CET', 'CST', 'GMT+1'];

        // Get all users from the database
        $users = User::all();

        foreach ($users as $user) {
            // Update each user's details with random values
            $user->update([
                'name' => $faker->name,
                'timezone' => $faker->randomElement($timezones),
            ]);

            $this->info("Updated user: {$user->name} , Timezone: {$user->timezone}");
        }

        $this->info('All users have been updated successfully.');
    }
}
