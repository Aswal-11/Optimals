<?php

namespace App\Http\Controllers;

// Models
use App\Models\Skill;

// Request
use App\Http\Requests\SkillRequest;
use Illuminate\Http\Request;

// Session
use Illuminate\Support\Facades\Session;

class SkillController extends Controller
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
        return view('skill.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SkillRequest $request)
    {
        $input = $request->validated();
        
        if ($input) {
            Skill::create($input);
            Session::flash('success', 'Skill created successfully.');

            return view('welcome');
        } else {
            Session::flash('error', 'Failed to create Skill.');

            return view('welcome');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Skill $skill)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Skill $skill)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Skill $skill)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Skill $skill)
    {
        //
    }
}
