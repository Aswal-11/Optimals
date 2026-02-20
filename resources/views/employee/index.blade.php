@extends('layouts.app')

@section('content')
    <div class="max-w-6xl mx-auto bg-white p-6 rounded shadow">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">
                Employee List
            </h2>

            <div class="flex gap-4">
                <a href="/admin/dashboard" class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">
                    Back
                </a>
                <a class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700" href="{{ route('employee.create') }}">Create employee</a>
            </div>
        </div>

        <table class="w-full border border-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-2 border">#</th>
                    <th class="p-2 border">Name</th>
                    <th class="p-2 border">Age</th>
                    <th class="p-2 border">Email</th>
                    <th class="p-2 border">Designation</th>
                    <th class="p-2 border">Salary</th>
                    <th class="p-2 border">View Profile</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($employees as $employee)
                    <tr class="text-center">
                        <td class="p-2 border">{{ $loop->iteration }}</td>
                        <td class="p-2 border">{{ $employee->name }}</td>
                        <td class="p-2 border">{{ $employee->age }}</td>
                        <td class="p-2 border">{{ $employee->email }}</td>
                        <td class="p-2 border">
                            {{ $employee->designation->title ?? 'N/A' }}
                        </td>
                        <td class="p-2 border">₹{{ $employee->salary }}</td>

                        <td class="p-2 border">
                            <a href="{{ route('employees.profile', $employee->id) }}"
                                class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700 text-sm">
                                View
                            </a>
                        </td>
                        <td class="p-2 border">
                            <a href="{{ route('employee.edit', $employee->id) }}"
                                class="bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700 text-sm">
                                Update
                            </a>
                        </td>
                    </tr>

                @empty
                    <tr>
                        <td colspan="6" class="p-4 text-center">
                            No Employees Found
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
