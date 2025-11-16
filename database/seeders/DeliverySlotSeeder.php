<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DeliverySlot;

class DeliverySlotSeeder extends Seeder
{
    public function run(): void
    {
        $slots = [
            [
                'slot_name' => 'Morning Slot',
                'start_time' => '08:00:00',
                'end_time' => '10:00:00',
            ],
            [
                'slot_name' => 'Late Morning',
                'start_time' => '10:00:00',
                'end_time' => '12:00:00',
            ],
            [
                'slot_name' => 'Afternoon Slot',
                'start_time' => '12:00:00',
                'end_time' => '14:00:00',
            ],
            [
                'slot_name' => 'Evening Slot',
                'start_time' => '16:00:00',
                'end_time' => '18:00:00',
            ],
            [
                'slot_name' => 'Night Slot',
                'start_time' => '18:00:00',
                'end_time' => '20:00:00',
            ],
        ];

        foreach ($slots as $slot) {
            // Only create if a slot with the same name does not exist
            DeliverySlot::firstOrCreate(
                ['slot_name' => $slot['slot_name']],
                [
                    'start_time' => $slot['start_time'],
                    'end_time' => $slot['end_time'],
                    'is_active' => true,
                ]
            );
        }

        $this->command->info('Delivery slots seeded successfully!');
    }
}
