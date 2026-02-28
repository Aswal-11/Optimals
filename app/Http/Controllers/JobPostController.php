<?php

namespace App\Http\Controllers;

// Models
use App\Models\JobPost;
use App\Models\Designation;
use App\Http\Requests\JobUpdateRequest;

// Request
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class JobPostController extends Controller
{
    public function index(Request $request)
    {
        $query = JobPost::with('designation');

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('description', 'like', "%{$search}%")
                    ->orWhere('location', 'like', "%{$search}%")
                    ->orWhere('salary', 'like', "%{$search}%")
                    ->orWhereHas('designation', function ($q2) use ($search) {
                        $q2->where('title', 'like', "%{$search}%");
                    });
            });
        }

        $jobPosts = $query->latest()->paginate(10)->withQueryString();

        return view('jobPost.index', compact('jobPosts'));
    }

    public function create()
    {
        $designations = Designation::pluck('title', 'id');

        return view('jobPost.create', compact('designations'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'designation_id' => 'required|exists:designations,id',
            'description' => 'required|string|min:10|max:1000',
            'location' => 'required|string|min:2|max:100',
            'salary' => 'required|numeric|min:0',
        ], [
            'designation_id.required' => 'Please select a designation.',
            'designation_id.exists' => 'Selected designation is invalid.',
            'description.required' => 'Description is required.',
            'description.min' => 'Description must be at least 10 characters.',
            'location.required' => 'Location is required.',
            'salary.required' => 'Salary is required.',
            'salary.numeric' => 'Salary must be a number.',
        ]);

        JobPost::create($validated);

        return redirect()->route('jobPost.index')
            ->with('success', 'Job Post created successfully!');
    }

    /**
     * Edit Job Post
     */
    public function edit(JobPost $jobPost)
    {
        $designations = Designation::pluck('title', 'id');

        if ($jobPost && $designations) {
            return view('jobPost.edit', compact('jobPost', 'designations'));
        } else {
            Session::flash('failed', 'Job Post not found.');

            return redirect()->route('jobPost.index');
        }
    }

    /**
     * Update Job Post
     */
    public function update(JobUpdateRequest $request, JobPost $jobPost)
    {
        $input = $request->validated();
        if ($input) {
            Session::flash('success', 'Job Post updated successfully.');
            $jobPost->update($input);

            return redirect()->route('jobPost.index');
        } else {
            Session::flash('failed', 'Failed to update Job Post.');

            return redirect()->route('jobPost.edit', $jobPost->id);
        }
    }

    /**
     * Delete Job Post
     */
    public function delete(JobPost $jobPost)
    {
        if ($jobPost) {
            Session::flash('success', 'Job Post deleted successfully.');
            $jobPost->delete();

            return redirect()->route('jobPost.index');
        }
    }
}
