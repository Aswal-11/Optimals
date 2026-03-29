<?php

namespace App\Http\Controllers;

// Models
use App\Models\Employee;
use App\Models\Designation;

// Requests
use Illuminate\Http\Request;
use App\Http\Requests\EmployeeStoreRequest;
use App\Http\Requests\EmployeeUpdateRequest;

// Authentication
use Illuminate\Support\Facades\Hash;

// Session
use Illuminate\Support\Facades\Session;

class EmployeeController extends Controller
{
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
        $this->authorize('viewAny', Employee::class);
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
        $this->authorize('create', Employee::class);
        $designations = Designation::pluck('title', 'id');

        return view('employee.create', compact('designations'));
    }

    /**
     * Store Employee
     */
    public function store(EmployeeStoreRequest $request)
    {
        $this->authorize('create', Employee::class);
        $input = $request->validated();
        $input['password'] = Hash::make($input['password']);

        if ($input) {
            Employee::create($input);
            Session::flash('success', 'Employee created successfully.');
        } else {
            Session::flash('error', 'Failed to create Employee.');
        }

        return redirect()->route('employee.index');
    }


    /**
     * Show Edit Employee Form
     */
    public function edit(Employee $employee)
    {
        $this->authorize('update', $employee);
        $designations = Designation::pluck('title', 'id');

        return view('employee.edit', compact('employee', 'designations'));
    }

    /**
     * Update Employee
     */
    public function update(EmployeeUpdateRequest $request, Employee $employee)
    {
        $this->authorize('update', $employee);
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
        $this->authorize('delete', $employee);
        $employee->delete();

        return redirect()->route('employee.index')
            ->with('success', 'Employee deleted successfully.');
    }
}
