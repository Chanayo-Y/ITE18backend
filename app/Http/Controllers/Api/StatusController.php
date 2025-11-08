<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $status = Status::all();
        return response()->json($status);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'status_name' => 'required|string|max:100',
        ]);

        $status = Status::create($validated);

        return response()->json([
            'message' => 'Status created successfully',
            'data' => $status
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $status = Status::find($id);

        if (!$status) {
            return response()->json(['message' => 'Status not found'], 404);
        }

        return response()->json($status);
    }

    public function update(Request $request, string $id)
    {
        $status = Status::find($id);

        if (!$status) {
            return response()->json(['message' => 'Status not found'], 404);
        }

        $validated = $request->validate([
            'status_name' => 'sometimes|string|max:100',
        ]);

        $status->update($validated);

        return response()->json([
            'message' => 'Status updated successfully',
            'data' => $status
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $status = Status::find($id);

        if (!$status) {
            return response()->json(['message' => 'Status not found'], 404);
        }

        $status->delete();

        return response()->json(['message' => 'Status deleted successfully']);
    }
}
