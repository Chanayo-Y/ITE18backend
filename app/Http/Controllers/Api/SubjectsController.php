<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SubjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subjects = Subject::with('user')->get();
        return response()->json($subjects);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'userID' => 'required|integer|exists:users,id',
            'subj_code' => 'required|string|max:20',
            'subj_name' => 'required|string|max:255',
            'units' => 'required|integer|min:0',
        ]);

        $subject = Subject::create($validated);

        return response()->json([
            'message' => 'Subject created successfully',
            'data' => $subject
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $subject = Subject::with('user')->find($id);

        if (!$subject) {
            return response()->json(['message' => 'Subject not found'], 404);
        }

        return response()->json($subject);
    }


    public function update(Request $request, string $id)
    {
        $subject = Subject::find($id);

        if (!$subject) {
            return response()->json(['message' => 'Subject not found'], 404);
        }

        $validated = $request->validate([
            'userID' => 'sometimes|integer|exists:users,id',
            'subj_code' => 'sometimes|string|max:20',
            'subj_name' => 'sometimes|string|max:255',
            'units' => 'sometimes|integer|min:0',
        ]);

        $subject->update($validated);

        return response()->json([
            'message' => 'Subject updated successfully',
            'data' => $subject
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $subject = Subject::find($id);

        if (!$subject) {
            return response()->json(['message' => 'Subject not found'], 404);
        }

        $subject->delete();

        return response()->json(['message' => 'Subject deleted successfully']);
    }
}
