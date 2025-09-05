<?php

namespace App\Http\Controllers\Api\Publisher;

use App\Http\Controllers\Controller;
use App\Http\Requests\Publisher\StoreEventRequest;
use App\Http\Requests\Publisher\UpdateEventRequest;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PublisherEventController extends Controller
{
    public function store(StoreEventRequest $request)
    {
        $data = $request->validated();
        $data['publisher_id'] = Auth::id();

        $event = Event::create($data);

        return response()->json($event, 201);
    }

    public function update(UpdateEventRequest $request, Event $event)
    {
        if ($event->publisher_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $event->update($request->validated());

        return response()->json($event);
    }
}
