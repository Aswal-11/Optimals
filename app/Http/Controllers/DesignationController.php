<?php

namespace App\Http\Controllers;

// Models
use App\Models\Skill;
use App\Models\Designation;

// Requests
use Illuminate\Http\Request;
use App\Http\Requests\DesignationStoreRequest;
use App\Http\Requests\DesignationUpdateRequest;

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
    public function index(Request $request)
    {
        $search = $request->query('search');

        $designations = Designation::with('skills')
            ->when($search, function ($query, $search) {
                $query->where('title', 'like', "%{$search}%");
            })
            ->paginate(2)
            ->withQueryString();

        return view('designation.index', compact('designations', 'search'));
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
    public function store(DesignationStoreRequest $request)
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
    public function update(DesignationUpdateRequest $request, $id)
    {
        $input = $request->validated();
        $skill_ids = $input['skill_id'] ?? [];
        unset($input['skill_id']);

        if ($input) {
            $designation = Designation::findOrFail($id);
            $designation->update($input);
            $designation->skills()->sync($skill_ids);
            Session::flash('success', 'Designation updated successfully ');
        } else {
            Session::flash('failed', 'Failed to update the designation');
        }

        return redirect()->route('designation.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Designation $designation)
    {
        $designation->delete();

        Session::flash('success', 'Designation deleted successfully.');

        return redirect()->route('designation.index');
    }
}
