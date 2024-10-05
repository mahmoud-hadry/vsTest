<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class UpdateUserBatch implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $batch;

    /**
     * Create a new job instance.
     *
     * @param array $batch
     * @return void
     */
    public function __construct(array $batch)
    {
        $this->batch = $batch;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Send the batch update request
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('API_TOKEN'),
            'Content-Type' => 'application/json',
        ])->post('https://api.endpoint', [
            'batches' => [$this->batch],
        ]);

        // Handle response
        if ($response->successful()) {
            // do something
        } else {
            // do something else
        }
    }
}
