<?php

namespace Database\Seeders;

use App\Models\BookingStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookingStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $statuses = [
            ['name' => 'created', 'display_name' => 'Создано'],
            ['name' => 'cancelled', 'display_name' => 'Отменено'],
            ['name' => 'completed', 'display_name' => 'Завершено'],
        ];

        foreach ($statuses as $status) {
            BookingStatus::firstOrCreate(
                ['name' => $status['name']],
                ['display_name' => $status['display_name']]
            );
        }
    }
}
