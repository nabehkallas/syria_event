<?php

namespace App\Http\Controllers\Api;

use App\Models\Event;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $query = Event::query();

        if ($request->has('city')) {
            $query->where('city', $request->input('city'));
        }

        if ($request->has('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('name', $request->input('category'));
            });
        }

        if ($request->has('date')) {
            $query->whereDate('start_time', $request->input('date'));
        }

        if ($request->has('q')) {
            $query->where('description', 'like', '%' . $request->input('q') . '%');
        }

       $events = $query->leftJoin('event_attendances', 'events.id', '=', 'event_attendances.event_id')
            ->select(
                'events.id',
                'events.city',
                'events.start_time',
                'events.description',
                // ... other columns from the events table ...
                DB::raw('COUNT(DISTINCT event_attendances.user_id) as attendees_count')
            )
            ->groupBy(
                'events.id',
                'events.city',
                'events.start_time',
                'events.description'
                // ... other columns from the events table ...
            )
            ->orderBy('attendees_count', 'desc')
            ->get();






        return response()->json($events);
    }
}