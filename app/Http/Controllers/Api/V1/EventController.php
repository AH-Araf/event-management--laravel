<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EventController extends Controller
{
    public function index()
    {
        return Event::all();
    }

    public function create()
    {
        // Not used in API
    }

    public function store(Request $request)
    {
        // Define allowed categories
        $allowedCategories = [
            'Conferences',
            'Workshops',
            'Seminars',
            'Webinars',
            'Festivals',
            'ProductLaunches',
            'CorporateMeetings',
            'TradeShows',
            'Fundraisers',
            'NetworkingEvents',
            'Music',
            'Dance',
            'Art',
            'Technology',
            'Health&Wellness',
        ];

        // Validate the incoming request
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
            'location' => 'required|string|max:255',
            'category' => ['required', 'string', 'max:255', Rule::in($allowedCategories)],
        ]);

        $event = Event::create($request->all());

        return response()->json($event, 201);
    }

    public function show(string $id)
    {
        $event = Event::findOrFail($id);

        return response()->json($event);
    }

    public function edit(string $id)
    {
        // Not used in API
    }

    public function update(Request $request, string $id)
    {
        // Define allowed categories
        $allowedCategories = [
            'Conferences',
            'Workshops',
            'Seminars',
            'Webinars',
            'Festivals',
            'ProductLaunches',
            'CorporateMeetings',
            'TradeShows',
            'Fundraisers',
            'NetworkingEvents',
            'Music',
            'Dance',
            'Art',
            'Technology',
            'Health&Wellness',
        ];

        // Validate the incoming request
        $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
            'date' => 'sometimes|required|date',
            'time' => 'sometimes|required|date_format:H:i',
            'location' => 'sometimes|required|string|max:255',
            'category' => ['sometimes', 'required', 'string', 'max:255', Rule::in($allowedCategories)],
        ]);

        $event = Event::findOrFail($id);
        $event->update($request->all());

        return response()->json($event);
    }

    public function destroy(string $id)
    {
        $event = Event::findOrFail($id);
        $event->delete();

        return response()->noContent();
    }

    public function getEventsByCategory($category)
    {
        $events = Event::where('category', $category)->get();
        
        if ($events->isEmpty()) {
            return response()->json(['message' => 'No events found in this category'], 404);
        }

        return response()->json($events);
    }
}
