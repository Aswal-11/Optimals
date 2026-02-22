<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Http\Requests\Api\EmployeeStoreRequest;
use App\Http\Requests\Api\EmployeeUpdateRequest;
use Illuminate\Http\JsonResponse;

class EmployeeController extends Controller
{
    /**
     * Display a listing of employees
     */
    public function index(): JsonResponse
    {
        $employees = Employee::with('designation')->latest()->get();

        return response()->json([
            'status' => true,
            'message' => 'Employee list fetched successfully',
            'data' => $employees
        ], 200);
    }

    /**
     * Store a newly created employee
     */
    public function store(EmployeeStoreRequest $request): JsonResponse
    {
        $data = $request->validated();
        $data['password'] = bcrypt($data['password']);

        $employee = Employee::create($data);

        return response()->json([
            'status' => true,
            'message' => 'Employee created successfully',
            'data' => $employee
        ], 201);
    }

    /**
     * Display the specified employee
     */
    public function show(Employee $employee): JsonResponse
    {
        $employee->load('designation');

        return response()->json([
            'status' => true,
            'message' => 'Employee fetched successfully',
            'data' => $employee
        ], 200);
    }

    /**
     * Update the specified employee
     */
    public function update(EmployeeUpdateRequest $request, Employee $employee): JsonResponse
    {
        $data = $request->validated();

        if (!empty($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        }

        $employee->update($data);

        return response()->json([
            'status' => true,
            'message' => 'Employee updated successfully',
            'data' => $employee
        ], 200);
    }

    /**
     * Remove the specified employee
     */
    public function destroy(Employee $employee): JsonResponse
    {
        $employee->delete();

        return response()->json([
            'status' => true,
            'message' => 'Employee deleted successfully'
        ], 200);
    }
}