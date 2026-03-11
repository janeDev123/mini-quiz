<x-layouts.app>
    <x-slot name="title">Student Dashboard</x-slot>

    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Hello, {{ auth()->user()->name }}! 👋</h1>
        <p class="text-gray-500 text-sm mt-1">Ready to test your knowledge today?</p>
    </div>

    <!-- Stats -->
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-8">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
            <p class="text-sm text-gray-500 font-medium">Total Attempts</p>
            <p class="text-3xl font-bold text-indigo-600 mt-1">{{ $totalAttempts }}</p>
        </div>
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
            <p class="text-sm text-gray-500 font-medium">Best Score</p>
            <p class="text-3xl font-bold text-emerald-600 mt-1">{{ $bestScore ?? 0 }}</p>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-8">
        <a href="{{ route('student.quiz.index') }}"
           class="flex items-center gap-4 bg-indigo-600 hover:bg-indigo-700 text-white rounded-2xl p-6 transition-colors group">
            <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center group-hover:bg-white/30 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div>
                <p class="font-bold text-lg">Take a Quiz</p>
                <p class="text-indigo-200 text-sm">Start a new quiz now</p>
            </div>
        </a>

        <a href="{{ route('student.history.index') }}"
           class="flex items-center gap-4 bg-white hover:bg-gray-50 text-gray-800 rounded-2xl border border-gray-100 p-6 transition-colors group shadow-sm">
            <div class="w-12 h-12 bg-gray-100 rounded-xl flex items-center justify-center group-hover:bg-gray-200 transition-colors">
                <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
            </div>
            <div>
                <p class="font-bold text-lg">View History</p>
                <p class="text-gray-500 text-sm">See past quiz results</p>
            </div>
        </a>
    </div>

    <!-- Recent Results -->
    @if ($recentResults->isNotEmpty())
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-semibold text-gray-800">Recent Results</h2>
                <a href="{{ route('student.history.index') }}"
                   class="text-sm text-indigo-600 hover:underline font-medium">View all →</a>
            </div>

            <div class="space-y-3">
                @foreach ($recentResults as $result)
                    <div class="flex items-center justify-between py-2 border-b border-gray-50 last:border-0">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full flex items-center justify-center text-xs font-bold
                                {{ $result->passed ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                {{ $result->passed ? '✓' : '✗' }}
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-800">{{ $result->score }}/{{ $result->total }} correct</p>
                                <p class="text-xs text-gray-400">{{ $result->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                        <span class="text-sm font-bold {{ $result->passed ? 'text-green-600' : 'text-red-500' }}">
                            {{ $result->percentage }}%
                        </span>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</x-layouts.app>