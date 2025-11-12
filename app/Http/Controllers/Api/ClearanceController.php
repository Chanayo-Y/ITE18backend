<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClearanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clearances = Clearance::with(['student.user', 'status', 'department'])->get();
        return response()->json($clearances);
    }

    /**
     * Show the form for creating a new resource.
     */

    public function store(Request $request)
    {
        $validated = $request->validate([
            'studentID' => 'required|integer|exists:students,studentID',
            'statusID' => 'required|integer|exists:statuses,statusID',
            'departmentID' => 'required|integer|exists:departments,departmentID',
        ]);

        $clearance = Clearance::create($validated);

        return response()->json([
            'message' => 'Clearance record created successfully',
            'data' => $clearance
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
         $clearance = Clearance::with(['student.user', 'status', 'department'])->find($id);

        if (!$clearance) {
            return response()->json(['message' => 'Clearance record not found'], 404);
        }

        return response()->json($clearance);
    }


    public function update(Request $request, string $id)
    {
        $clearance = Clearance::find($id);

        if (!$clearance) {
            return response()->json(['message' => 'Clearance record not found'], 404);
        }

        $validated = $request->validate([
            'studentID' => 'sometimes|integer|exists:students,studentID',
            'statusID' => 'sometimes|integer|exists:statuses,statusID',
            'departmentID' => 'sometimes|integer|exists:departments,departmentID',
        ]);

        $clearance->update($validated);

        return response()->json([
            'message' => 'Clearance record updated successfully',
            'data' => $clearance
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $clearance = Clearance::find($id);

        if (!$clearance) {
            return response()->json(['message' => 'Clearance record not found'], 404);
        }

        $clearance->delete();

        return response()->json(['message' => 'Clearance record deleted successfully']);
    }
}
