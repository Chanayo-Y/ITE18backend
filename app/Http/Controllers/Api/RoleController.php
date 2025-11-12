<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Role::all());
    }

    /**
     * Show the form for creating a new resource.
     */

    public function store(Request $request)
    {
        $validated = $request->validate([
            'role_name' => 'required|string|max:50'
        ]);
        $role = Role::create($validated);
        return response()->json(['message' => 'Role created', 'data' => $role], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $role = Role::find($id);
        if (!$role) return response()->json(['message' => 'Role not found'], 404);
        return response()->json($role);
    }

    public function update(Request $request, string $id)
    {
        $role = Role::find($id);
        if (!$role) return response()->json(['message' => 'Role not found'], 404);

        $validated = $request->validate([
            'role_name' => 'sometimes|string|max:50'
        ]);
        $role->update($validated);
        return response()->json(['message' => 'Role updated', 'data' => $role]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role = Role::find($id);
        if (!$role) return response()->json(['message' => 'Role not found'], 404);
        $role->delete();
        return response()->json(['message' => 'Role deleted']);
    }
}
