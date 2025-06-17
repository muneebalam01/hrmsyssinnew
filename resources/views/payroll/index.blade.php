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
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-semibold text-gray-800 dark:text-white">Payroll Management</h1>
                <a href="{{ route('payroll.create') }}"
                   class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded">
                    Add Payroll
                </a>
            </div>

            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="overflow-x-auto bg-white dark:bg-gray-800 shadow-md rounded-lg">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-100 dark:bg-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 dark:text-gray-300">#</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 dark:text-gray-300">Employee</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 dark:text-gray-300">Basic Salary</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 dark:text-gray-300">Allowances</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 dark:text-gray-300">Deductions</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 dark:text-gray-300">Net Salary</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 dark:text-gray-300">Pay Date</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse ($payrolls as $payroll)
                            <tr>
                                <td class="px-6 py-4 text-gray-900 dark:text-white">{{ $loop->iteration }}</td>
                                <td class="px-6 py-4 text-gray-900 dark:text-white">
                                    {{ $payroll->employee->first_name ?? '' }} {{ $payroll->employee->last_name ?? '' }}
                                </td>
                                <td class="px-6 py-4 text-gray-900 dark:text-white">{{ number_format($payroll->basic_salary, 2) }}</td>
                                <td class="px-6 py-4 text-gray-900 dark:text-white">{{ number_format($payroll->allowances, 2) }}</td>
                                <td class="px-6 py-4 text-gray-900 dark:text-white">{{ number_format($payroll->deductions, 2) }}</td>
                                <td class="px-6 py-4 text-gray-900 dark:text-white">{{ number_format($payroll->net_salary, 2) }}</td>
                                <td class="px-6 py-4 text-gray-900 dark:text-white">
                                    {{ \Carbon\Carbon::parse($payroll->pay_date)->format('d M Y') }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                    No payroll records found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>
@endsection
