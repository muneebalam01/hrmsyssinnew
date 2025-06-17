@extends('layouts.app')

@section('content')
<style>
    a.bg-blue-600.hover\:bg-blue-700.text-white.font-medium.py-2.px-4.rounded {
        background-color: blue;
    }
    button.bg-blue-600.hover\:bg-blue-700.text-white.font-medium.py-2.px-4.rounded {
        background-color: blue !important;
    }
</style>

<div class="flex min-h-screen">
    @include('layouts.sidebar')

    <main class="flex-1 p-6">
        <div class="max-w-3xl mx-auto bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
            <h2 class="text-2xl font-bold mb-6 text-gray-800 dark:text-white">Add Payroll</h2>

            @if ($errors->any())
                <div class="mb-4 p-4 bg-red-100 text-red-800 rounded">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('payroll.store') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label class="block text-gray-700 dark:text-gray-200 font-medium mb-1">Employee</label>
                    <select name="employee_id" class="w-full border-gray-300 rounded-lg dark:bg-gray-700 dark:text-white">
                        @foreach($employees as $emp)
                            <option value="{{ $emp->id }}">{{ $emp->first_name }} {{ $emp->last_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-gray-700 dark:text-gray-200 font-medium mb-1">Basic Salary</label>
                    <input type="number" name="basic_salary" step="0.01"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 dark:bg-gray-700 dark:text-white">
                </div>

                <div>
                    <label class="block text-gray-700 dark:text-gray-200 font-medium mb-1">Allowances</label>
                    <input type="number" name="allowances" step="0.01"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 dark:bg-gray-700 dark:text-white">
                </div>

                <div>
                    <label class="block text-gray-700 dark:text-gray-200 font-medium mb-1">Deductions</label>
                    <input type="number" name="deductions" step="0.01"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 dark:bg-gray-700 dark:text-white">
                </div>

                <div>
                    <label class="block text-gray-700 dark:text-gray-200 font-medium mb-1">Pay Date</label>
                    <input type="date" name="pay_date"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 dark:bg-gray-700 dark:text-white">
                </div>

                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded mt-4">
                    Submit
                </button>
            </form>
        </div>
    </main>
</div>
@endsection
