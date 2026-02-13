<?php

namespace App\Console\Commands\Cache;

use App\Services\Service\ServiceServiceInterface;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class WarmCacheCommand extends Command
{

    public function __construct(private ServiceServiceInterface $serviceService)
    {
        parent::__construct();
    }

    protected $signature = 'redis:warm-cache
                            {key-name : Redis key name}
                            {--t|ttl=300 : Redis key TTL}
                            ';

    protected $description = 'Redis warm cache';

    public function handle()
    {
        try {

            $this->info('Redis cache has started warming up');
            Log::info('Redis cache has started warming up');
            
            $keyName = $this->argument('key-name');

            $ttl = $this->ask('Enter Redis key ttl:', $this->option('ttl'));

            $this->info("Redis key TTL: {$ttl}");
            Log::info("Redis key TTL: {$ttl}");

            $services = Cache::remember($keyName, $ttl, fn() => $this->serviceService->getServices());

            $progressBar = $this->output->createProgressBar(count($services));

            $progressBar->start();

            foreach ($services as $service) {
                usleep(10000);
                $progressBar->advance();
            }

            $progressBar->finish();
        
            $this->newLine(1);

            $this->info("Redis cache warming is complete for key: {$keyName}, ttl: {$ttl}");
            Log::info("Redis cache warming is complete for key: {$keyName}, ttl: {$ttl}");
            
            return self::SUCCESS;

        } catch (\Throwable $exeption) {
            $this->error($exeption->getMessage());
            Log::error('Redis cache warming is failed', $exeption->getMessage());

            return self::FAILURE;
        }
    }
}
