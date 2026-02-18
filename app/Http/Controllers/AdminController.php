<?php

namespace App\Http\Controllers;

// Models
use App\Models\Admin;

// Requests
use Illuminate\Http\Request;
use App\Http\Requests\AdminRequest;
use App\Http\Requests\LoginAuthenticateRequest;

// Authentication
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

// Session
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function login()
    {
        return view('admin.login');
    }

    // Authenticate admin credentials and Login
    public function authenticate(LoginAuthenticateRequest $request)
    {
        $credentials = $request->validated();

        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();
            Session::flash('success', 'Admin logged in successfully.');
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['email' => 'Invalid credentials'])->onlyInput('email');
    }

    public function create()
    {
        return view('admin.create');
    }

    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Logged out successfully');
    }

    public function store(AdminRequest $request)
    {
        $request->validated();
        Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'New Admin Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Admin $admin)
    {
       //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Admin $admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Admin $admin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Admin $admin)
    {
        //
    }
}
