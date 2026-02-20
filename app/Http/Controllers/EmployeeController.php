<?php

namespace App\Http\Controllers;

// Models
use App\Http\Requests\EmployeeAuthenticateRequest;
use App\Http\Requests\EmployeeRequest;
// Requests
use App\Models\Designation;
use App\Models\Employee;
use Illuminate\Http\Request;
// Authentication
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
// Session
use Illuminate\Support\Facades\Session;

class EmployeeController extends Controller
{
    /**
     * Show the employee login form
     */
    public function login()
    {
        return view('employee.authenticate.employee_login');
    }

    /**
     * Emoloyee authentication
     */
    public function authenticate(EmployeeAuthenticateRequest $request)
    {
        $credentials = $request->validated();

        if (Auth::guard('employee')->attempt($credentials)) {
            $request->session()->regenerate();
            Session::flash('success', 'Employee logged in successfully.');

            return redirect()->intended(route('employee.profile'));
        }

        return back()->withErrors(['email' => 'Invalid credentials'])->onlyInput('email');
    }

    /**
     * Show the logged-in employee's own profile (no ID in URL).
     */
    public function myProfile()
    {
        $employee = Auth::guard('employee')->user();
        $employee->load('designation.skills');

        return view('employee.profile', compact('employee'));
    }

    /**
     * Show employee profile by ID (admin viewing any employee).
     */
    public function profile(Employee $employee)
    {
        $employee->load('designation.skills');

        return view('employee.profile', compact('employee'));
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (! Auth::guard('admin')->check()) {
            abort(403, 'Unauthorized');
        }
        $employees = Employee::with('designation')->get();

        return view('employee.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (! Auth::guard('admin')->check()) {
            abort(403, 'Unauthorized');
        }
        $designations = Designation::pluck('title', 'id');

        return view('employee.create', compact('designations'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmployeeRequest $request)
    {
        if (! Auth::guard('admin')->check()) {
            abort(403, 'Unauthorized');
        }
        $input = $request->validated();
        $input['password'] = Hash::make($input['password']);

        if ($input) {
            Employee::create($input);
            Session::flash('success', 'Employee created successfully.');
        } else {
            Session::flash('error', 'Failed to create Employee.');
        }

        return redirect()->route('admin.dashboard');
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        $designations = Designation::pluck('title', 'id');

        return view('employee.edit', compact('employee', 'designations'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee)
    {
        // Validation
        $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|integer|min:18',
            'email' => 'required|email|unique:employees,email,'.$employee->id,
            'designation_id' => 'required|exists:designations,id',
            'salary' => 'required|numeric|min:0',
            'password' => 'nullable|confirmed|min:6',
        ]);

        // Data collect karo
        $data = $request->only([
            'name',
            'age',
            'email',
            'designation_id',
            'salary',
        ]);

        // Agar password fill kiya hai to update karo
        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        }

        // Update employee
        $employee->update($data);

        return redirect()
            ->route('employee.index')
            ->with('success', 'Employee updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        //
    }

    /**
     * Logout employee
     */
    public function logout(Request $request)
    {
        Auth::guard('employee')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        Session::flash('success', 'Logged out successfully.');

        return redirect()->route('employee.login');
    }
}
