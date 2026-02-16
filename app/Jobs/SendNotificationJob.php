<?php

namespace App\Jobs;

use App\Models\Service;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;

class SendNotificationJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public readonly User $user,
        public readonly Service $service

    )
    {
        
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Log::channel('telegram')->info("Пользователь {$this->user->name} создал сервис {$this->service}");
    }
}
