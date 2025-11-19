<?php

namespace Database\Seeders;

use App\Models\Resource;
use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ResourceServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = Service::all();
        $resources = Resource::all();

        foreach ($services as $service) {
            $randomResources = $resources->random(rand(1, 10));
            
            $service->resources()->attach($randomResources);
        }
    }
}
