<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TranscriptController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transcripts = Transcript::with(['student.user', 'grade'])->get();
        return response()->json($transcripts);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'gradeID' => 'required|integer|exists:grades,gradeID',
            'studentID' => 'required|integer|exists:students,studentID',
        ]);

        $transcript = Transcript::create($validated);

        return response()->json([
            'message' => 'Transcript created successfully',
            'data' => $transcript
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $transcript = Transcript::with(['student.user', 'grade'])->find($id);

        if (!$transcript) {
            return response()->json(['message' => 'Transcript not found'], 404);
        }

        return response()->json($transcript);
    }

    public function update(Request $request, string $id)
    {
        $transcript = Transcript::find($id);

        if (!$transcript) {
            return response()->json(['message' => 'Transcript not found'], 404);
        }

        $validated = $request->validate([
            'gradeID' => 'sometimes|integer|exists:grades,gradeID',
            'studentID' => 'sometimes|integer|exists:students,studentID',
        ]);

        $transcript->update($validated);

        return response()->json([
            'message' => 'Transcript updated successfully',
            'data' => $transcript
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $transcript = Transcript::find($id);

        if (!$transcript) {
            return response()->json(['message' => 'Transcript not found'], 404);
        }

        $transcript->delete();

        return response()->json(['message' => 'Transcript deleted successfully']);
    }
}
