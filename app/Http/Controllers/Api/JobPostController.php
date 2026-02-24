<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\JobPost;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class JobPostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        return response()->json([
            'data' => JobPost::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'location' => 'required|string|max:255',
            'salary' => 'nullable|numeric',
        ]);

        $jobPost = JobPost::create($validated);

        return response()->json([
            'message' => 'Job created successfully',
            'data' => $jobPost,
        ], 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, JobPost $jobPost)
    {
        $validated = $request->validate([
            'title' => 'sometimes|string|max:255',
            'description' => 'sometimes',
            'location' => 'sometimes|string|max:255',
            'salary' => 'nullable|numeric',
        ]);

        $jobPost->update($validated);

        return response()->json([
            'message' => 'Job updated successfully',
            'data' => $jobPost,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(JobPost $jobPost)
    {
        $jobPost->delete();

        return response()->json([
            'message' => 'Job deleted successfully',
        ]);
    }
}
