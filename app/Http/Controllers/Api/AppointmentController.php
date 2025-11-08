<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $appointments = Appointment::with(['user', 'employee.user', 'status'])->get();
        return response()->json($appointments);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function store(Request $request)
    {
        // Validate input
        $validated = $request->validate([
            'statusID' => 'required|integer|exists:statuses,statusID',
            'userID' => 'required|integer|exists:users,id',
            'employeeID' => 'required|integer|exists:employees,employeeID',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
        ]);

        $appointment = Appointment::create($validated);

        return response()->json([
            'message' => 'Appointment created successfully',
            'data' => $appointment
        ], 201);
    }

    public function show(string $id)
    {
        $appointment = Appointment::with(['user', 'employee.user', 'status'])->find($id);

        if (!$appointment) {
            return response()->json(['message' => 'Appointment not found'], 404);
        }

        return response()->json($appointment);
    }


    public function update(Request $request, string $id)
    {
        $appointment = Appointment::find($id);

        if (!$appointment) {
            return response()->json(['message' => 'Appointment not found'], 404);
        }

        $validated = $request->validate([
            'statusID' => 'sometimes|integer|exists:statuses,statusID',
            'userID' => 'sometimes|integer|exists:users,id',
            'employeeID' => 'sometimes|integer|exists:employees,employeeID',
            'date' => 'sometimes|date',
            'time' => 'sometimes|date_format:H:i',
        ]);

        $appointment->update($validated);

        return response()->json([
            'message' => 'Appointment updated successfully',
            'data' => $appointment
        ]);
    }

    public function destroy(string $id)
    {
        $appointment = Appointment::find($id);

        if (!$appointment) {
            return response()->json(['message' => 'Appointment not found'], 404);
        }

        $appointment->delete();

        return response()->json(['message' => 'Appointment deleted successfully']);
    }

}
