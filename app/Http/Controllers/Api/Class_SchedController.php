<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Class_SchedController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $schedules = ClassSched::with(['employee.user', 'room', 'subject'])->get();
        return response()->json($schedules);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'employeeID' => 'required|integer|exists:employees,employeeID',
            'roomID' => 'required|integer|exists:rooms,roomID',
            'day' => 'required|string|max:20',
            'time' => 'required|date_format:H:i',
            'subjectID' => 'required|integer|exists:subjects,subjectID',
        ]);

        $schedule = ClassSched::create($validated);

        return response()->json([
            'message' => 'Class schedule created successfully',
            'data' => $schedule
        ], 201);
    }

    public function show(string $id)
    {
        $schedule = ClassSched::with(['employee.user', 'room', 'subject'])->find($id);

        if (!$schedule) {
            return response()->json(['message' => 'Class schedule not found'], 404);
        }

        return response()->json($schedule);
    }

    public function update(Request $request, string $id)
    {
        $schedule = ClassSched::find($id);

        if (!$schedule) {
            return response()->json(['message' => 'Class schedule not found'], 404);
        }

        $validated = $request->validate([
            'employeeID' => 'sometimes|integer|exists:employees,employeeID',
            'roomID' => 'sometimes|integer|exists:rooms,roomID',
            'day' => 'sometimes|string|max:20',
            'time' => 'sometimes|date_format:H:i',
            'subjectID' => 'sometimes|integer|exists:subjects,subjectID',
        ]);

        $schedule->update($validated);

        return response()->json([
            'message' => 'Class schedule updated successfully',
            'data' => $schedule
        ]);
    }

    public function destroy(string $id)
    {
        $schedule = ClassSched::find($id);

        if (!$schedule) {
            return response()->json(['message' => 'Class schedule not found'], 404);
        }

        $schedule->delete();

        return response()->json(['message' => 'Class schedule deleted successfully']);
    }
}
