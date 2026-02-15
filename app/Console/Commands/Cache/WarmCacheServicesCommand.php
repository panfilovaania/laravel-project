<?php

namespace App\Console\Commands\Cache;

use App\Services\Service\ServiceServiceInterface;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class WarmCacheServicesCommand extends Command
{

    public function __construct(private ServiceServiceInterface $serviceService)
    {
        parent::__construct();
    }

    protected $signature = 'redis:warm-cache-services
                            {key-name-prefix : Redis key prefix name}
                            {--t|ttl=300 : Redis key TTL}
                            ';

    protected $description = 'Redis warming services cache';

    public function handle()
    {
        try {
            $services = $this->serviceService->getServices();

            if ($services->isNotEmpty())
            {
                $this->info('Redis cache has started warming up');
                Log::info('Redis cache has started warming up');
                
                $keyNamePrefix = $this->argument('key-name-prefix');

                $ttl = $this->ask('Enter Redis key ttl:', $this->option('ttl'));

                $this->info("Redis key TTL: {$ttl}");
                Log::info("Redis key TTL: {$ttl}");

                $progressBar = $this->output->createProgressBar(count($services));
    
                $progressBar->start();
    
                foreach ($services as $service)
                {
                    Cache::put("{$keyNamePrefix}_{$service->id}", $service, $ttl);

                    $progressBar->advance();
                }
    
                $progressBar->finish();
            
                $this->newLine(1);
                $this->info("Redis cache warming is complete for key: {$keyNamePrefix}, ttl: {$ttl}");
                Log::info("Redis cache warming is complete for key: {$keyNamePrefix}, ttl: {$ttl}");
                
                return self::SUCCESS;
            }
            else
            {
                $this->newLine(1);
                $this->warn("Redis cache warming is failed. Services not found.");
                Log::warning("Redis cache warming is failed. Services not found.");

                return self::INVALID;
            }
        }
        catch (\Throwable $exeption) {
            $this->error($exeption->getMessage());
            Log::error('Redis cache warming is failed', $exeption->getMessage());

            return self::FAILURE;
        } 
    }
}
