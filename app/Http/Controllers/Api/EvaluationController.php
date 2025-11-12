<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EvaluationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $evaluations = Evaluation::with(['student.user', 'rate', 'employee.user'])->get();
        return response()->json($evaluations);
    }

    /**
     * Show the form for creating a new resource.
     */

    public function store(Request $request)
    {
        $validated = $request->validate([
            'studentID' => 'required|integer|exists:students,studentID',
            'rateID' => 'required|integer|exists:rates,rateID',
            'employeeID' => 'required|integer|exists:employees,employeeID',
        ]);

        $evaluation = Evaluation::create($validated);

        return response()->json([
            'message' => 'Evaluation created successfully',
            'data' => $evaluation
        ], 201); 
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $evaluation = Evaluation::with(['student.user', 'rate', 'employee.user'])->find($id);

        if (!$evaluation) {
            return response()->json(['message' => 'Evaluation not found'], 404);
        }

        return response()->json($evaluation);       
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function update(Request $request, string $id)
    {
        $evaluation = Evaluation::find($id);

        if (!$evaluation) {
            return response()->json(['message' => 'Evaluation not found'], 404);
        }

        $validated = $request->validate([
            'studentID' => 'sometimes|integer|exists:students,studentID',
            'rateID' => 'sometimes|integer|exists:rates,rateID',
            'employeeID' => 'sometimes|integer|exists:employees,employeeID',
        ]);

        $evaluation->update($validated);

        return response()->json([
            'message' => 'Evaluation updated successfully',
            'data' => $evaluation
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $evaluation = Evaluation::find($id);

        if (!$evaluation) {
            return response()->json(['message' => 'Evaluation not found'], 404);
        }

        $evaluation->delete();

        return response()->json(['message' => 'Evaluation deleted successfully']);
    }
}
