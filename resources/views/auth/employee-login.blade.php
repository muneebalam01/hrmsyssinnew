<!-- resources/views/auth/employee-login.blade.php -->
@extends('layouts.app')
<style>
    a.bg-blue-600.hover\:bg-blue-700.text-white.font-medium.py-2.px-4.rounded {
        background-color: blue;
    }
    button.bg-blue-600.hover\:bg-blue-700.text-white.py-2.px-4.rounded {
    background-color: blue;
}
.max-w-md.mx-auto.mt-10 {
    width: 60%;
}
</style>

@section('content')
<div class="max-w-md mx-auto mt-10">
    <h2 class="text-2xl font-bold mb-6">Employee Login</h2>

    <form method="POST" action="{{ route('employee.login.submit') }}">
        @csrf

        <div class="mb-4">
            <label for="email" class="block text-sm font-medium">Email</label>
            <input type="email" name="email" id="email" required autofocus
                   class="w-full px-3 py-2 border rounded">
            @error('email') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label for="password" class="block text-sm font-medium">Password</label>
            <input type="password" name="password" id="password" required
                   class="w-full px-3 py-2 border rounded">
            @error('password') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="flex justify-between items-center mb-4">
            <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded">
                Login
            </button>
        </div>
    </form>
</div>
@endsection
