<?php

namespace App\Http\Controllers;

// Models
use App\Models\Employee;
use App\Models\Designation;

// Requests
use Illuminate\Http\Request;
use App\Http\Requests\EmployeeRequest;
use App\Http\Requests\EmployeeUpdateRequest;
use App\Http\Requests\EmployeeAuthenticateRequest;

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
     * Show Employee
     */
    public function index(Request $request)
    {
        $search = $request->query('search');

        $employees = Employee::with('designation')
            ->when($search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhereHas('designation', function ($q) use ($search) {
                        $q->where('title', 'like', "%{$search}%");
                    });
            })
            ->paginate(2)
            ->withQueryString(); // keeps search during pagination

        return view('employee.index', compact('employees', 'search'));
    }


    /**
     * Create Employee
     */
    public function create()
    {
        $designations = Designation::pluck('title', 'id');

        return view('employee.create', compact('designations'));
    }

    /**
     * Store Employee
     */
    public function store(EmployeeRequest $request)
    {
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
     * Show Edit Employee Form
     */
    public function edit(Employee $employee)
    {
        $designations = Designation::pluck('title', 'id');

        return view('employee.edit', compact('employee', 'designations'));
    }

    /**
     * Update Employee
     */
    public function update(EmployeeUpdateRequest $request, Employee $employee)
    {
        // Validation
        $input = $request->validated();

        if ($request->filled('password')) {
            $input['password'] = bcrypt($request->password);
        }

        // Update employee
        $employee->update($input);

        Session::flash('success', 'Employee updated successfully.');

        return redirect()->route('employee.index');
    }

    /**
     * Delete Employee
     */
    public function delete(Employee $employee)
    {
        $employee->delete();

        return redirect()->route('employee.index')
            ->with('success', 'Employee deleted successfully.');
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
