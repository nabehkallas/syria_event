<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Event;
use App\Models\User;
use App\Models\EventAttendance;
use App\Enums\UserRole;

class EventAttendanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $events = Event::all();
        $attendees = User::where('role', UserRole::ATTENDEE)->get();

        for ($i = 0; $i < 30; $i++) {
            EventAttendance::create([
                'event_id' => $events->random()->id,
                'user_id' => $attendees->random()->id,
            ]);
        }
    }
}