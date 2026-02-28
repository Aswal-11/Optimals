<?php

namespace App\Http\Controllers\Api;

// Models
use App\Models\Designation;
use App\Models\JobPost;

// Requests
use App\Http\Requests\Api\JobPostStoreRequest;
use App\Http\Requests\Api\JobPostUpdateRequest;

// Controller 
use App\Http\Controllers\Controller;

// Json
use Illuminate\Http\JsonResponse;

class JobPostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $jobs = JobPost::with('designation')->get();

        return response()->json([
            'data' => $jobs,
        ]);
    }

    public function create(): JsonResponse
    {
        $designations = Designation::pluck('title', 'id');

        return response()->json([
            'designations' => $designations,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(JobPostStoreRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $jobPost = JobPost::create($validated);

        return response()->json([
            'message' => 'Job created successfully',
            'data' => $jobPost,
        ], 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(JobPostUpdateRequest $request, JobPost $jobPost)
    {
        $validated = $request->validated();

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
