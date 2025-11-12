<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $grades = Grade::with('subject')->get();
        return response()->json($grades);      
    }

    /**
     * Show the form for creating a new resource.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'subjectID' => 'required|integer|exists:subjects,subjectID',
            'grade' => 'required|numeric|between:0,100',
        ]);

        $grade = Grade::create($validated);

        return response()->json([
            'message' => 'Grade created successfully',
            'data' => $grade
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $grade = Grade::with('subject')->find($id);

        if (!$grade) {
            return response()->json(['message' => 'Grade not found'], 404);
        }

        return response()->json($grade);
    }

    /**
     * Show the form for editing the specified resource.
     */

    public function update(Request $request, string $id)
    {
        $grade = Grade::find($id);

        if (!$grade) {
            return response()->json(['message' => 'Grade not found'], 404);
        }

        $validated = $request->validate([
            'subjectID' => 'sometimes|integer|exists:subjects,subjectID',
            'grade' => 'sometimes|numeric|between:0,100',
        ]);

        $grade->update($validated);

        return response()->json([
            'message' => 'Grade updated successfully',
            'data' => $grade
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $grade = Grade::find($id);

        if (!$grade) {
            return response()->json(['message' => 'Grade not found'], 404);
        }

        $grade->delete();

        return response()->json(['message' => 'Grade deleted successfully']);
    }
}
