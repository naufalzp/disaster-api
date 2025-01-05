<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\DisasterResource;
use App\Models\Disaster;
use Illuminate\Http\Request;

class DisasterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $disasters = Disaster::with('user')->get();

        return response()->json([
            'status' => 'success',
            'message' => 'Disasters retrieved successfully',
            'data' => DisasterResource::collection($disasters)
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'location' => 'required|string',
            'description' => 'required|string',
            'severity' => 'required|in:low,medium,high',
            'time' => 'required|string',
            'date' => 'required|date',
        ]);

        if (!$validated) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation error',
                'errors' => $validated
            ], 400);
        }

        $validated['created_by'] = $request->user()->id;

        $disaster = Disaster::create($validated);

        $disaster->load('user');

        return response()->json([
            'status' => 'success',
            'message' => 'Disaster created successfully',
            'data' => new DisasterResource($disaster)
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(int $id)
    {
        $disaster = Disaster::find($id);

        if (!$disaster) {
            return response()->json([
                'status' => 'error',
                'message' => 'Disaster not found'
            ], 404);
        }

        $disaster->load('user');

        return response()->json([
            'status' => 'success',
            'message' => 'Disaster retrieved successfully',
            'data' => new DisasterResource($disaster)
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, int $id)
    {
        $disaster = Disaster::find($id);
        
        if (!$disaster) {
            return response()->json([
                'status' => 'error',
                'message' => 'Disaster not found'
            ], 404);
        }

        if ($request->user()->id != $disaster->created_by) {
            return response()->json([
                'status' => 'error',
                'message' => 'You are not authorized to update this disaster'
            ], 403);
        }

        $validated = $request->validate([
            'location' => 'string',
            'description' => 'string',
            'severity' => 'in:low,medium,high',
            'time' => 'string',
            'date' => 'date',
        ]);

        if (!$validated) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation error',
                'errors' => $validated
            ], 400);
        }

        $disaster->update($validated);

        $disaster->load('user');

        return response()->json([
            'status' => 'success',
            'message' => 'Disaster updated successfully',
            'data' => new DisasterResource($disaster)
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request ,int $id)
    {
        $disaster = Disaster::find($id);

        if (!$disaster) {
            return response()->json([
                'status' => 'error',
                'message' => 'Disaster not found'
            ], 404);
        }

        if ($request->user()->id != $disaster->created_by) {
            return response()->json([
                'status' => 'error',
                'message' => 'You are not authorized to delete this disaster'
            ], 403);
        }

        $disaster->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Disaster deleted successfully'
        ], 200);
    }
}
