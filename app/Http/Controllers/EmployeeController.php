<?php
namespace App\Http\Controllers;

// Models
use App\Models\Designation;
use App\Models\Employee;

// Requests
use App\Http\Requests\EmployeeRequest;
use Illuminate\Http\Request;

// Session
use Illuminate\Support\Facades\Session;

class EmployeeController extends Controller
{
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
        $employees = Employee::with('designation')->get();
        return view('employee.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $designations = Designation::pluck('title', 'id');
        return view('employee.create', compact('designations'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmployeeRequest $request)
    {
        $input = $request->validated();
        if ($input) {
            Employee::create($input);
            Session::flash('success', 'Employee created successfully.');

            return view('welcome');
        } else {
            Session::flash('error', 'Failed to create Employee.');

            return view('welcome');
        }
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        //
    }
}
