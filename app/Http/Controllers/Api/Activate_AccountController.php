<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ActivateAccount;
use App\Models\Student;



class Activate_AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $accounts = ActivateAccount::with('student')->get();
        return response()->json($accounts);
    }

 
    public function store(Request $request)
    {
        $validated = $request->validate([
            'activate_at' => 'required|date',
            'studentID' => 'required|integer|exists:students,studentID',
        ]);

        $activation = ActivateAccount::create($validated);

        return response()->json([
            'message' => 'Account activation record created successfully',
            'data' => $activation
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $activation = ActivateAccount::with('student.user')->find($id);

        if (!$activation) {
            return response()->json(['message' => 'Activation record not found'], 404);
        }

        return response()->json($activation);
    }

    public function update(Request $request, string $id)
    {
        $account = ActivateAccount::find($id);

        if (!$account) {
            return response()->json(['message' => 'Activate Account not found'], 404);
        }

        $validated = $request->validate([
            'activate_at' => 'sometimes|date',
            'studentID' => 'sometimes|integer|exists:students,studentID',
        ]);

        $account->update($validated);

        return response()->json([
            'message' => 'Activate Account updated successfully',
            'data' => $account
        ]);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $account = ActivateAccount::find($id);

        if (!$account) {
            return response()->json(['message' => 'Activate Account not found'], 404);
        }

        $account->delete();

        return response()->json(['message' => 'Activate Account deleted successfully']);
    }
}
