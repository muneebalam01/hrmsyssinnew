<!-- resources/views/employee/dashboard.blade.php -->
@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto mt-10">
    <h1 class="text-3xl font-bold">Welcome, {{ Auth::guard('employee')->user()->first_name }}!</h1>
    <p class="mt-4">This is the employee dashboard.</p>
    <form action="{{ route('employee.logout') }}" method="POST">
        @csrf
        <button type="submit" class="mt-4 bg-red-600 text-white px-4 py-2 rounded">Logout</button>
    </form>
</div>
@endsection
