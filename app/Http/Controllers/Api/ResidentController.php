<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Resident;
use App\Http\Requests\ResidentRequest;

class ResidentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $residents = Resident::all();
        return response()->json(['residents' => $residents], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ResidentRequest $request)
    {
        $resident = Resident::create($request->validated());
        return response()->json(['resident' => $resident], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $resident = Resident::findOrFail($id);
        return response()->json(['resident' => $resident], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ResidentRequest $request, string $id)
    {
        $resident = Resident::findOrFail($id);
        $resident->update($request->validated());
        return response()->json(['resident' => $resident], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $resident = Resident::findOrFail($id);
        $resident->delete();
        return response()->json(['message' => 'Resident deleted successfully'], 200);
    }
}
