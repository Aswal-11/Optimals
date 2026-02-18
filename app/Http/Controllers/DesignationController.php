<?php

namespace App\Http\Controllers;

// Models
use App\Http\Requests\DesignationRequest;
use App\Models\Designation;
// Requests
use App\Models\Skill;
use Illuminate\Http\Request;
// Session
use Illuminate\Support\Facades\Session;

class DesignationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
            if (!empty($skill_ids)) {
                $designation->skills()->attach($skill_ids);
            }
            Session::flash('success', 'Designation created successfully.');
        }else{
            Session::flash('failed', 'Failed to create the designation');
        }

        return redirect()->route('admin.dashboard');
    }

    /**
     * Display the specified resource.
     */
    public function show(Designation $designation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Designation $designation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Designation $designation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Designation $designation)
    {
        //
    }
}
