@extends('layouts.app')

@section('content')
<div class="flex min-h-screen bg-gray-100">
  @include('layouts.sidebar')

  <main class="flex-1 p-8">
    <div class="max-w-4xl mx-auto bg-white rounded-2xl shadow-md p-8">
      <h2 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-2">Add New Employee</h2>

      <form action="{{ route('employees.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

       <div class="flex space-x-4">
  <div class="w-1/2">
    <label for="first_name" class="block text-sm font-medium text-gray-700">First Name</label>
    <input type="text" name="first_name" id="first_name" value="{{ old('first_name') }}"
           class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
    @error('first_name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
  </div>

  <div class="w-1/2">
    <label for="last_name" class="block text-sm font-medium text-gray-700">Last Name</label>
    <input type="text" name="last_name" id="last_name" value="{{ old('last_name') }}"
           class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
    @error('last_name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
  </div>
</div>


        <div>
          <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
          <input type="email" name="email" id="email" value="{{ old('email') }}"
                 class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
          @error('email') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
          <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
          <input type="password" name="password" id="password"
                 class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
          @error('password') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
          <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
          <input type="text" name="phone" id="phone" value="{{ old('phone') }}"
                 class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
          @error('phone') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
          <label for="position" class="block text-sm font-medium text-gray-700">Position</label>
          <input type="text" name="position" id="position" value="{{ old('position') }}"
                 class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
          @error('position') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
          <label for="department_id" class="block text-sm font-medium text-gray-700">Department</label>
          <select name="department_id" id="department_id"
                  class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
            <option value="">Select department</option>
            @foreach($departments as $dept)
              <option value="{{ $dept->id }}" {{ old('department_id') == $dept->id ? 'selected' : '' }}>
                {{ $dept->name }}
              </option>
            @endforeach
          </select>
          @error('department_id') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
          <label for="salary" class="block text-sm font-medium text-gray-700">Salary</label>
          <input type="number" step="0.01" name="salary" id="salary" value="{{ old('salary') }}"
                 class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
          @error('salary') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
          <label for="hired_at" class="block text-sm font-medium text-gray-700">Hire Date</label>
          <input type="date" name="hired_at" id="hired_at" value="{{ old('hired_at') }}"
                 class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
          @error('hired_at') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>


        <div>
  <label class="block text-sm font-medium text-gray-700">Search Roles</label>
  
  <!-- Search Input -->
  <input type="text" id="roleSearch"
         placeholder="Type to search roles..."
         class="mt-1 block w-full px-4 py-2 mb-3 border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">

  <!-- Checkboxes List -->
  <div id="rolesList" class="space-y-2 max-h-48 overflow-y-auto border p-3 rounded-md">
    @foreach($roles as $role)
      <label class="flex items-center role-item">
        <input type="checkbox" name="role_id[]" value="{{ $role->id }}"
               {{ is_array(old('role_id')) && in_array($role->id, old('role_id')) ? 'checked' : '' }}
               class="form-checkbox text-blue-600">
        <span class="ml-2 text-gray-700">{{ ucfirst($role->name) }}</span>
      </label>
    @endforeach
  </div>

  @error('role_id') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
</div>


        <div>
          <label for="profile_picture" class="block text-sm font-medium text-gray-700">Profile Picture</label>
          <input type="file" name="profile_picture" id="profile_picture" accept="image/*"
                 class="mt-1 block w-full text-gray-700">
          @error('profile_picture') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="flex justify-between pt-4">
          <button type="submit"
                  class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg shadow">
            Save Employee
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



<script>
  document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('roleSearch');
    const roleItems = document.querySelectorAll('.role-item');

    searchInput.addEventListener('input', function () {
      const query = searchInput.value.toLowerCase();

      roleItems.forEach(item => {
        const text = item.textContent.toLowerCase();
        item.style.display = text.includes(query) ? '' : 'none';
      });
    });
  });
</script>
