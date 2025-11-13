<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Program;
use App\Models\Yearlvl;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::with(['program', 'yearlvl', 'user'])->get();
        return response()->json($students);
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'programID' => 'required|integer|exists:programs,id',
            'yearID' => 'required|integer|exists:yearlvls,id',
            'userID' => 'required|integer|exists:users,id'
        ]);

        $student = Student::create($validated);
        return response()->json(['message' => 'Student record created', 'data' => $student], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $student = Student::with(['program', 'yearlvl', 'user'])->find($id);
        if (!$student) return response()->json(['message' => 'Student not found'], 404);
        return response()->json($student);
    }

    public function update(Request $request, string $id)
    {
        $student = Student::find($id);
        if (!$student) return response()->json(['message' => 'Student not found'], 404);

        $validated = $request->validate([
            'programID' => 'sometimes|integer|exists:programs,id',
            'yearID' => 'sometimes|integer|exists:yearlvls,id',
            'userID' => 'sometimes|integer|exists:users,id'
        ]);

        $student->update($validated);
        return response()->json(['message' => 'Student updated', 'data' => $student]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $student = Student::find($id);
        if (!$student) return response()->json(['message' => 'Student not found'], 404);
        $student->delete();
        return response()->json(['message' => 'Student deleted']);
    }
}
