<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource. 
     */
    public function index()
    {
        // Retrieve all events
        return Event::all();
    }

    /**
     * Show the form for creating a new resource.
     * This method is not usually used in APIs, so you can omit it if you want.
     */
    public function create()
    {
        // Not typically used in APIs
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
            'location' => 'required|string|max:255',
            'category' => 'required|string|max:255',
        ]);

        // Create a new event
        $event = Event::create($request->all());

        // Return a response with the created event
        return response()->json($event, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Retrieve a specific event by ID
        $event = Event::findOrFail($id);

        // Return the event
        return response()->json($event);
    }

    /**
     * Show the form for editing the specified resource.
     * This method is not usually used in APIs, so you can omit it if you want.
     */
    public function edit(string $id)
    {
        // Not typically used in APIs
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate the incoming request
        $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
            'date' => 'sometimes|required|date',
            'time' => 'sometimes|required|date_format:H:i',
            'location' => 'sometimes|required|string|max:255',
            'category' => 'sometimes|required|string|max:255',
        ]);

        // Find the event to update
        $event = Event::findOrFail($id);

        // Update the event with the request data
        $event->update($request->all());

        // Return a response with the updated event
        return response()->json($event);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the event to delete
        $event = Event::findOrFail($id);
        
        // Delete the event
        $event->delete();

        // Return a no-content response
        return response()->noContent();
    }
}
