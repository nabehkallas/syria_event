<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Event;
use App\Models\User;
use App\Models\Category;
use App\Enums\UserRole;
use App\Enums\EventStatus;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $publishers = User::where('role', UserRole::PUBLISHER)->get();
        $categories = Category::all();

        for ($i = 0; $i < 10; $i++) {
            Event::create([
                'title' => 'Event ' . $i,
                'description' => 'This is a description for event ' . $i,
                'start_time' => now()->addDays($i),
                'end_time' => now()->addDays($i)->addHours(2),
                'city' => 'City ' . $i,
                'location_details' => 'Location details for event ' . $i,
                'price' => rand(10, 100),
                'publisher_id' => $publishers->random()->id,
                'category_id' => $categories->random()->id,
                'status' => EventStatus::PUBLISHED,
            ]);
        }
    }
}