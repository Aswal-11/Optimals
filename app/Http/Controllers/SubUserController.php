<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\SubUser;
use Illuminate\Http\Request;

class SubUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', SubUser::class);

        $subusers = SubUser::with('role')->get();
        return view('subusers.index', compact('subusers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', SubUser::class);

        $roles = Role::orderBy('name')->get();
        return view('subusers.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:sub_users,email',
            'password' => 'required|string|min:8',
            'role_id' => 'nullable|exists:roles,id',
        ]);

        SubUser::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role_id' => $request->role_id,
        ]);
        return redirect()->route('subusers.index')->with('success', 'Subuser created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(SubUser $subuser)
    {
        $this->authorize('view', $subuser);

        return view('subusers.show', compact('subuser'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SubUser $subuser)
    {
        $this->authorize('update', $subuser);

        $roles = Role::orderBy('name')->get();
        return view('subusers.edit', compact('subuser', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SubUser $subuser)
    {
        $this->authorize('update', $subuser);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:sub_users,email,' . $subuser->id,
            'password' => 'nullable|string|min:8',
            'role_id' => 'nullable|exists:roles,id',
        ]);

        $data = $request->only(['name', 'email', 'role_id']);
        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        }

        $subuser->update($data);
        return redirect()->route('subusers.index')->with('success', 'Subuser updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SubUser $subuser)
    {
        $this->authorize('delete', $subuser);

        $subuser->delete();
        return redirect()->route('subusers.index')->with('success', 'Subuser deleted successfully');
    }
}
