@extends('layouts.app')

@section('content')
<div class="flex min-h-screen bg-gray-100">
  @include('layouts.sidebar')

  <main class="flex-1 p-8">
    <div class="max-w-4xl mx-auto bg-white rounded-2xl shadow-md p-8">
      <h2 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-2">Edit Employee</h2>

      <form action="{{ route('employees.update', $employee->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <div class="flex space-x-4">
          <div class="w-1/2">
            <label for="first_name" class="block text-sm font-medium text-gray-700">First Name</label>
            <input type="text" id="first_name" name="first_name" value="{{ old('first_name', $employee->first_name) }}"
                   class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
            @error('first_name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
          </div>

          <div class="w-1/2">
            <label for="last_name" class="block text-sm font-medium text-gray-700">Last Name</label>
            <input type="text" id="last_name" name="last_name" value="{{ old('last_name', $employee->last_name) }}"
                   class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
            @error('last_name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
          </div>
        </div>

        <div>
          <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
          <input type="email" id="email" name="email" value="{{ old('email', $employee->email) }}"
                 class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
          @error('email') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
          <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
          <input type="text" id="phone" name="phone" value="{{ old('phone', $employee->phone) }}"
                 class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
          @error('phone') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
          <label for="position" class="block text-sm font-medium text-gray-700">Position</label>
          <input type="text" id="position" name="position" value="{{ old('position', $employee->position) }}"
                 class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
          @error('position') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
          <label for="department_id" class="block text-sm font-medium text-gray-700">Department</label>
          <select id="department_id" name="department_id"
                  class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
            <option value="">Select department</option>
            @foreach($departments as $dept)
              <option value="{{ $dept->id }}" {{ old('department_id', $employee->department_id) == $dept->id ? 'selected' : '' }}>
                {{ $dept->name }}
              </option>
            @endforeach
          </select>
          @error('department_id') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
          <label for="salary" class="block text-sm font-medium text-gray-700">Salary</label>
          <input type="number" step="0.01" id="salary" name="salary" value="{{ old('salary', $employee->salary) }}"
                 class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
          @error('salary') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
          <label for="hired_at" class="block text-sm font-medium text-gray-700">Hire Date</label>
          <input type="date" id="hired_at" name="hired_at"
                 value="{{ old('hired_at', $employee->hired_at ? \Carbon\Carbon::parse($employee->hired_at)->format('Y-m-d') : '') }}"
                 class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
          @error('hired_at') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
          <label for="profile_picture" class="block text-sm font-medium text-gray-700">Profile Picture</label>
          <input type="file" id="profile_picture" name="profile_picture" accept="image/*"
                 class="mt-1 block w-full text-gray-700">
          @error('profile_picture') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="flex justify-between pt-4">
          <button type="submit"
                  class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg shadow">
            Update Employee
          </button>
          <a href="{{ route('employees.index') }}"
             class="text-gray-600 hover:text-blue-600 font-medium hover:underline">
            Cancel
          </a>
        </div>
      </form>
    </div>
  </main>
</div>
@endsection
