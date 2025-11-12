<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Program;

class ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $programs = Program::all();
        return response()->json($programs);
    }

    /**
     * Show the form for creating a new resource.
     */

    public function store(Request $request)
    {
        $validated = $request->validate([
            'program_code' => 'required|string|max:20|unique:programs,program_code',
            'program_name' => 'required|string|max:100',
        ]);

        $program = Program::create($validated);

        return response()->json([
            'message' => 'Program created successfully',
            'data' => $program
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $program = Program::find($id);

        if (!$program) {
            return response()->json(['message' => 'Program not found'], 404);
        }

        return response()->json($program);
    }

    /**
     * Show the form for editing the specified resource.
     */

    public function update(Request $request, string $id)
    {
        $program = Program::find($id);

        if (!$program) {
            return response()->json(['message' => 'Program not found'], 404);
        }

        $validated = $request->validate([
            'program_code' => 'sometimes|string|max:20|unique:programs,program_code,' . $id . ',programID',
            'program_name' => 'sometimes|string|max:100',
        ]);

        $program->update($validated);

        return response()->json([
            'message' => 'Program updated successfully',
            'data' => $program
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $program = Program::find($id);

        if (!$program) {
            return response()->json(['message' => 'Program not found'], 404);
        }

        $program->delete();

        return response()->json(['message' => 'Program deleted successfully']);
    }
}
