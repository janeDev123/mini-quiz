<x-layouts.admin>
    <x-slot name="title">Admin Dashboard</x-slot>

    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Dashboard</h1>
        <p class="text-gray-500 text-sm mt-1">Welcome back, {{ auth()->user()->name }}!</p>
    </div>

    <!-- Stats -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-8">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
            <p class="text-sm text-gray-500 font-medium">Total Students</p>
            <p class="text-3xl font-bold text-indigo-600 mt-1">{{ $totalStudents }}</p>
        </div>
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
            <p class="text-sm text-gray-500 font-medium">Total Questions</p>
            <p class="text-3xl font-bold text-purple-600 mt-1">{{ $totalQuestions }}</p>
        </div>
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
            <p class="text-sm text-gray-500 font-medium">Quiz Attempts</p>
            <p class="text-3xl font-bold text-emerald-600 mt-1">{{ $totalResults }}</p>
        </div>
    </div>

    <!-- Recent Results -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-lg font-semibold text-gray-800">Recent Quiz Attempts</h2>
            <a href="{{ route('admin.results.index') }}"
               class="text-sm text-indigo-600 hover:underline font-medium">View all →</a>
        </div>

        @if ($recentResults->isEmpty())
            <p class="text-gray-400 text-sm text-center py-6">No quiz attempts yet.</p>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="text-left text-gray-500 border-b border-gray-100">
                            <th class="pb-3 font-medium">Student</th>
                            <th class="pb-3 font-medium">Score</th>
                            <th class="pb-3 font-medium">Date</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @foreach ($recentResults as $result)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="py-3 font-medium text-gray-800">{{ $result->user->name }}</td>
                                <td class="py-3">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold
                                        {{ $result->passed ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                        {{ $result->score }}/{{ $result->total }} ({{ $result->percentage }}%)
                                    </span>
                                </td>
                                <td class="py-3 text-gray-500">{{ $result->created_at->diffForHumans() }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</x-layouts.admin>