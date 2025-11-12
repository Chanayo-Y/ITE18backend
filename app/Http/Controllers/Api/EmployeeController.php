<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Department;
use App\Models\User;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employee::with(['department', 'user'])->get();
        return response()->json($employees);
    }

    /**
     * Show the form for creating a new resource.
     */

    public function store(Request $request)
    {
        $validated = $request->validate([
            'deptID' => 'required|integer|exists:departments,deptID',
            'position' => 'required|string|max:100',
            'userID' => 'required|integer|exists:users,id',
        ]);

        $employee = Employee::create($validated);

        return response()->json([
            'message' => 'Employee created successfully',
            'data' => $employee
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $employee = Employee::with(['department', 'user'])->find($id);

        if (!$employee) {
            return response()->json(['message' => 'Employee not found'], 404);
        }

        return response()->json($employee);
    }

    /**
     * Show the form for editing the specified resource.
     */

    public function update(Request $request, string $id)
    {
        $employee = Employee::find($id);

        if (!$employee) {
            return response()->json(['message' => 'Employee not found'], 404);
        }

        $validated = $request->validate([
            'deptID' => 'sometimes|integer|exists:departments,deptID',
            'position' => 'sometimes|string|max:100',
            'userID' => 'sometimes|integer|exists:users,id',
        ]);

        $employee->update($validated);

        return response()->json([
            'message' => 'Employee updated successfully',
            'data' => $employee
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $employee = Employee::find($id);

        if (!$employee) {
            return response()->json(['message' => 'Employee not found'], 404);
        }

        $employee->delete();

        return response()->json(['message' => 'Employee deleted successfully']);
        }
}
