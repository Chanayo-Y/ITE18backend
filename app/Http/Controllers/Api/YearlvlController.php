<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class YearsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $yearlvls = YearLvl::all();
        return response()->json($yearlvls);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'yearlvl' => 'required|integer|min:1|max:12',
        ]);

        $yearlvl = YearLvl::create($validated);

        return response()->json([
            'message' => 'Year level created successfully',
            'data' => $yearlvl
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $yearlvl = YearLvl::find($id);

        if (!$yearlvl) {
            return response()->json(['message' => 'Year level not found'], 404);
        }

        return response()->json($yearlvl);
    }


    public function update(Request $request, string $id)
    {
        $yearlvl = YearLvl::find($id);

        if (!$yearlvl) {
            return response()->json(['message' => 'Year level not found'], 404);
        }

        $validated = $request->validate([
            'yearlvl' => 'sometimes|integer|min:1|max:12',
        ]);

        $yearlvl->update($validated);

        return response()->json([
            'message' => 'Year level updated successfully',
            'data' => $yearlvl
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $yearlvl = YearLvl::find($id);

        if (!$yearlvl) {
            return response()->json(['message' => 'Year level not found'], 404);
        }

        $yearlvl->delete();

        return response()->json(['message' => 'Year level deleted successfully']);
    }
}
