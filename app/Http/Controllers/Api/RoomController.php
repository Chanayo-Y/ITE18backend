<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Room;    

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rooms = Room::with('classSched')->get();
        return response()->json($rooms);
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'room_name' => 'required|string|max:255',
            'roomtype' => 'required|string|max:50',
            'schedID' => 'required|integer|exists:class_scheds,schedID',
        ]);

        $room = Room::create($validated);

        return response()->json([
            'message' => 'Room created successfully',
            'data' => $room
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $room = Room::with('classSched')->find($id);

        if (!$room) {
            return response()->json(['message' => 'Room not found'], 404);
        }

        return response()->json($room);
    }

    public function update(Request $request, string $id)
    {
        $room = Room::find($id);

        if (!$room) {
            return response()->json(['message' => 'Room not found'], 404);
        }

        $validated = $request->validate([
            'room_name' => 'sometimes|string|max:255',
            'roomtype' => 'sometimes|string|max:50',
            'schedID' => 'sometimes|integer|exists:class_scheds,schedID',
        ]);

        $room->update($validated);

        return response()->json([
            'message' => 'Room updated successfully',
            'data' => $room
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $room = Room::find($id);

        if (!$room) {
            return response()->json(['message' => 'Room not found'], 404);
        }

        $room->delete();

        return response()->json(['message' => 'Room deleted successfully']);
    }
}
