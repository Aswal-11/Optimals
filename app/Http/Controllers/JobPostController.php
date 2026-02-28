<?php

namespace App\Http\Controllers;

// Models
use App\Models\Designation;
use App\Models\JobPost;

// Request
use Illuminate\Http\Request;
use App\Http\Requests\JobUpdateRequest;


class JobPostController extends Controller
{
    public function index(Request $request)
    {
        
        $jobPosts = JobPost::with('designation')->get();

        return view('jobPost.index', compact('jobPosts'));
    }

    public function create()
    {
        $designations = Designation::pluck('title', 'id');

        return view('jobPost.create', compact('designations'));
    }

    public function edit(JobPost $jobPost)
    {
        $designations = Designation::pluck('title', 'id');

        return view('jobPost.edit', compact('jobPost', 'designations'));
    }

    public function update(JobUpdateRequest $request, JobPost $jobPost)
    {
        $input = $request->validated();

        $jobPost->update($input);

        return redirect()->route('jobPost.index')->with('success', 'Job post updated successfully.');
    }

    /**
     * Delete Job Post
     */
    public function delete(JobPost $jobPost)
    {
        $jobPost->delete();

        return redirect()->route('jobPost.index')
            ->with('success', 'Job Post deleted successfully.');
    }
}
