@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header">
            <h4>Add Skill</h4>
        </div>

        <div class="card-body">
            <form action="{{ route('skill.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Skill Name</label>
                    <input 
                        type="text" 
                        name="name" 
                        class="form-control @error('name') is-invalid @enderror"
                        placeholder="Enter skill name"
                        value="{{ old('name') }}"
                        required
                    >

                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">
                    Save Skill
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
