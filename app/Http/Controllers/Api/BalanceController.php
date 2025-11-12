<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BalanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $balances = Balance::with(['student.user', 'status'])->get();
        return response()->json($balances);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'studentID' => 'required|integer|exists:students,studentID',
            'amount' => 'required|numeric|min:0',
            'statusID' => 'required|integer|exists:statuses,statusID',
        ]);

        $balance = Balance::create($validated);

        return response()->json([
            'message' => 'Balance record created successfully',
            'data' => $balance
        ], 201);
    }

    public function show(string $id)
    {
        $balance = Balance::with(['student.user', 'status'])->find($id);

        if (!$balance) {
            return response()->json(['message' => 'Balance record not found'], 404);
        }

        return response()->json($balance);
    }

    public function update(Request $request, string $id)
    {
        $balance = Balance::find($id);

        if (!$balance) {
            return response()->json(['message' => 'Balance record not found'], 404);
        }

        $validated = $request->validate([
            'studentID' => 'sometimes|integer|exists:students,studentID',
            'amount' => 'sometimes|numeric|min:0',
            'statusID' => 'sometimes|integer|exists:statuses,statusID',
        ]);

        $balance->update($validated);

        return response()->json([
            'message' => 'Balance record updated successfully',
            'data' => $balance
        ]);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $balance = Balance::find($id);

        if (!$balance) {
            return response()->json(['message' => 'Balance record not found'], 404);
        }

        $balance->delete();

        return response()->json(['message' => 'Balance record deleted successfully']);
    }
}
