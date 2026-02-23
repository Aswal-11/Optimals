<?php

namespace App\Http\Controllers;

// Models
use App\Models\Skill;
use App\Models\Designation;

// Requests
use Illuminate\Http\Request;
use App\Http\Requests\DesignationRequest;

// Session
use Illuminate\Support\Facades\Session;

class DesignationController extends Controller
{
    /**
     * Show Designation Detail
     */
    public function show(Designation $designation)
    {
        $designation->load('skills');

        return view('designation.show', compact('designation'));
    }

    /**
     * List Designations
     */
    public function index()
    {
        $designations = Designation::with('skills')->paginate(5);

        return view('designation.index', compact('designations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $skills = Skill::pluck('name', 'id');

        return view('designation.create', compact('skills'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DesignationRequest $request)
    {
        $input = $request->validated();
        $skill_ids = $input['skill_id'] ?? [];
        unset($input['skill_id']);

        if ($input) {
            $designation = Designation::create($input);
            if (! empty($skill_ids)) {
                $designation->skills()->attach($skill_ids);
            }
            Session::flash('success', 'Designation created successfully.');
        } else {
            Session::flash('failed', 'Failed to create the designation');
        }

        return redirect()->route('designation.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $designation = Designation::with('skills')->findOrFail($id);
        $skills = Skill::pluck('name', 'id');

        return view('designation.edit', compact('designation', 'skills'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'skill_id' => 'nullable|array',
        ]);

        $designation = Designation::findOrFail($id);

        $designation->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        // Sync many-to-many skills
        $designation->skills()->sync($request->skill_id);

        return redirect()->route('designation.index')
            ->with('success', 'Designation updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Designation $designation)
    {
        //
    }
}
