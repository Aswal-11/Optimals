@extends('layouts.app')

@section('title', 'Home Page')

@section('content')

   <div class="flex gap-4">
     <a class="border-3" href={{ route('admin.login') }}>Login as admin</a>
     <a class="border-3" href={{ route('employee.login')}}>Login as Employee</a>
   </div>
@endsection