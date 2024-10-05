<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\UpdateUserBatch;
use App\Models\User;

class UpdateUserAttributes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:update-attributes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update user attributes using the third-party batch API';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Get users with changed attributes
        $changedUsers = User::where('attributes_changed', true)->get();

        // Break users into chunks of 1,000 for batch requests
        $batches = $changedUsers->chunk(1000);

        foreach ($batches as $batch) {
            // Prepare batch payload
            $batchPayload = [
                'subscribers' => $batch->map(function ($user) {
                    return [
                        'email' => $user->email,
                        'time_zone' => $user->time_zone,
                        'name' => $user->name, // Add other attributes as needed
                    ];
                })->toArray(),
            ];

            // Dispatch job for each batch
            dispatch(new UpdateUserBatch($batchPayload));
        }

        $this->info('User attributes update process started successfully.');

        return 0;
    }
}
