<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $enrollments = Enrollment::with(['student.user', 'yearlvl', 'status', 'class_sched'])->get();
        return response()->json($enrollments);
    }

    /**
     * Show the form for creating a new resource.
     */

    public function store(Request $request)
    {
        $validated = $request->validate([
            'studentID' => 'required|integer|exists:students,studentID',
            'semester' => 'required|string|max:50',
            'yearID' => 'required|integer|exists:yearlvls,yearID',
            'statusID' => 'required|integer|exists:statuses,statusID',
            'schedID' => 'required|integer|exists:class_scheds,schedID',
        ]);

        $enrollment = Enrollment::create($validated);

        return response()->json([
            'message' => 'Enrollment created successfully',
            'data' => $enrollment
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $enrollment = Enrollment::with(['student.user', 'yearlvl', 'status', 'class_sched'])->find($id);

        if (!$enrollment) {
            return response()->json(['message' => 'Enrollment not found'], 404);
        }

        return response()->json($enrollment);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function update(Request $request, string $id)
    {
        $enrollment = Enrollment::find($id);

        if (!$enrollment) {
            return response()->json(['message' => 'Enrollment not found'], 404);
        }

        $validated = $request->validate([
            'studentID' => 'sometimes|integer|exists:students,studentID',
            'semester' => 'sometimes|string|max:50',
            'yearID' => 'sometimes|integer|exists:yearlvls,yearID',
            'statusID' => 'sometimes|integer|exists:statuses,statusID',
            'schedID' => 'sometimes|integer|exists:class_scheds,schedID',
        ]);

        $enrollment->update($validated);

        return response()->json([
            'message' => 'Enrollment updated successfully',
            'data' => $enrollment
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $enrollment = Enrollment::find($id);

        if (!$enrollment) {
            return response()->json(['message' => 'Enrollment not found'], 404);
        }

        $enrollment->delete();

        return response()->json(['message' => 'Enrollment deleted successfully']);
    }
}
