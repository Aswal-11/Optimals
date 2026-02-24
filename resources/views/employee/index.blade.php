@extends('layouts.app')

@section('content')
    <div class="max-w-6xl mx-auto bg-white p-6 rounded shadow">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">
                Employee List
            </h2>


        </div>

        <div class="flex justify-between items-center ">
            <form method="GET" action="{{ route('employee.index') }}" class="mb-4">
                <div class="flex gap-2">
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Search by name, email, or designation"
                        class="border px-4 py-2 rounded w-72 focus:outline-none focus:ring">

                    <button type="submit" class="bg-gray-800 text-white px-4 py-2 rounded hover:bg-gray-700">
                        Search
                    </button>

                    @if (request('search'))
                        <a href="{{ route('employee.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">
                            Clear
                        </a>
                    @endif
                </div>
            </form>

            <div class="flex gap-4">
                <a href="/admin/dashboard" class="bg-gray-800 text-white px-4 py-2 rounded hover:bg-gray-700">
                    Back
                </a>
                <a class="bg-gray-800 text-white px-4 py-2 rounded hover:bg-gray-700"
                    href="{{ route('employee.create') }}">Create employee</a>
            </div>
        </div>
        
        <table class="w-full border border-gray-200">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="p-2 border">#</th>
                    <th class="p-2 border">Name</th>
                    <th class="p-2 border">Age</th>
                    <th class="p-2 border">Email</th>
                    <th class="p-2 border">Designation</th>
                    <th class="p-2 border">Salary</th>
                    <th class="p-2 border">View Profile</th>
                    <th class="p-2 border">Update</th>
                    <th class="p-2 border">Delete</th>
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
                        <td class="p-2 border">
                            <form action="{{ route('employee.delete', $employee->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded">
                                    Delete
                                </button>
                            </form>
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
        <div class="mt-4">
            {{ $employees->links() }}
        </div>
    </div>
@endsection
