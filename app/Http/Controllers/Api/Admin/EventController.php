<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Event;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EventController extends Controller
{
    public function index()
    {
        return Event::all();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'description' => 'required|string',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
            'city' => 'required|string',
            'status' => 'required|in:upcoming,ongoing,past',
            'category_id' => 'required|exists:categories,id',
            'user_id' => 'required|exists:users,id',
        ]);

        $event = Event::create($validated);

        return response()->json($event, 201);
    }

    public function show(Event $event)
    {
        return $event;
    }

    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'description' => 'string',
            'start_time' => 'date',
            'end_time' => 'date|after:start_time',
            'city' => 'string',
            'status' => 'in:upcoming,ongoing,past',
            'category_id' => 'exists:categories,id',
            'user_id' => 'exists:users,id',
        ]);

        $event->update($validated);

        return response()->json($event);
    }

    public function destroy(Event $event)
    {
        $event->delete();

        return response()->json(null, 204);
    }
}
