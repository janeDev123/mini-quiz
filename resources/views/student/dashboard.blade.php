<x-layouts.app>
    <x-slot name="title">Student Dashboard</x-slot>

    {{-- Greeting --}}
    <div class="mb-8">
        <div class="flex items-center gap-3 mb-1">
            <span class="inline-block px-3 py-1 bg-violet-100 text-violet-700 text-xs font-semibold rounded-full tracking-widest uppercase">Dashboard</span>
        </div>
        <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Hello, {{ auth()->user()->name }}! <span class="wave">👋</span></h1>
        <p class="text-gray-400 text-sm mt-1 font-medium">Ready to test your knowledge today?</p>
    </div>

    {{-- Stats --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-8">
        <div class="relative overflow-hidden bg-gradient-to-br from-violet-600 to-indigo-700 rounded-2xl p-6 shadow-lg shadow-violet-200">
            <div class="absolute -top-4 -right-4 w-24 h-24 bg-white/10 rounded-full"></div>
            <div class="absolute -bottom-6 -left-4 w-32 h-32 bg-white/5 rounded-full"></div>
            <p class="text-violet-200 text-xs font-semibold uppercase tracking-widest mb-1">Total Attempts</p>
            <p class="text-4xl font-black text-white">{{ $totalAttempts }}</p>
            <div class="mt-3 flex items-center gap-1.5">
                <svg class="w-4 h-4 text-violet-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                </svg>
                <span class="text-violet-300 text-xs font-medium">quizzes taken</span>
            </div>
        </div>

        <div class="relative overflow-hidden bg-gradient-to-br from-emerald-500 to-teal-600 rounded-2xl p-6 shadow-lg shadow-emerald-100">
            <div class="absolute -top-4 -right-4 w-24 h-24 bg-white/10 rounded-full"></div>
            <div class="absolute -bottom-6 -left-4 w-32 h-32 bg-white/5 rounded-full"></div>
            <p class="text-emerald-100 text-xs font-semibold uppercase tracking-widest mb-1">Best Score</p>
            <p class="text-4xl font-black text-white">{{ $bestScore ?? 0 }}</p>
            <div class="mt-3 flex items-center gap-1.5">
                <svg class="w-4 h-4 text-emerald-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                </svg>
                <span class="text-emerald-200 text-xs font-medium">personal best</span>
            </div>
        </div>
    </div>

    {{-- Quick Actions --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-8">
        <a href="{{ route('student.quiz.index') }}"
           class="group relative flex items-center gap-4 bg-gray-900 hover:bg-gray-800 text-white rounded-2xl p-6 transition-all duration-200 shadow-xl shadow-gray-900/20 hover:shadow-gray-900/30 hover:-translate-y-0.5">
            <div class="w-12 h-12 bg-violet-500 group-hover:bg-violet-400 rounded-xl flex items-center justify-center transition-colors flex-shrink-0">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div>
                <p class="font-bold text-lg leading-tight">Take a Quiz</p>
                <p class="text-gray-400 text-sm mt-0.5">Start a new quiz now</p>
            </div>
            <svg class="w-5 h-5 text-gray-500 ml-auto group-hover:text-gray-300 group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
        </a>

        <a href="{{ route('student.history.index') }}"
           class="group relative flex items-center gap-4 bg-white hover:bg-gray-50 text-gray-800 rounded-2xl border border-gray-200 p-6 transition-all duration-200 shadow-sm hover:shadow-md hover:-translate-y-0.5">
            <div class="w-12 h-12 bg-gray-100 group-hover:bg-gray-200 rounded-xl flex items-center justify-center transition-colors flex-shrink-0">
                <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
            </div>
            <div>
                <p class="font-bold text-lg leading-tight">View History</p>
                <p class="text-gray-400 text-sm mt-0.5">See past quiz results</p>
            </div>
            <svg class="w-5 h-5 text-gray-300 ml-auto group-hover:text-gray-500 group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
        </a>
    </div>

    {{-- Recent Results --}}
    @if ($recentResults->isNotEmpty())
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-50">
                <div class="flex items-center gap-2">
                    <div class="w-2 h-2 bg-violet-500 rounded-full"></div>
                    <h2 class="text-base font-bold text-gray-800">Recent Results</h2>
                </div>
                <a href="{{ route('student.history.index') }}"
                   class="inline-flex items-center gap-1 text-xs font-semibold text-violet-600 hover:text-violet-800 transition-colors">
                    View all
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>

            <div class="divide-y divide-gray-50">
                @foreach ($recentResults as $result)
                    <div class="flex items-center justify-between px-6 py-4 hover:bg-gray-50/70 transition-colors">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-xl flex items-center justify-center text-sm font-bold flex-shrink-0
                                {{ $result->passed
                                    ? 'bg-emerald-50 text-emerald-600 ring-1 ring-emerald-200'
                                    : 'bg-red-50 text-red-500 ring-1 ring-red-200' }}">
                                {{ $result->passed ? '✓' : '✗' }}
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-gray-800">
                                    {{ $result->score }}<span class="text-gray-400 font-normal">/{{ $result->total }}</span> correct
                                </p>
                                <p class="text-xs text-gray-400 mt-0.5">{{ $result->created_at->diffForHumans() }}</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-3">
                            <div class="h-1.5 w-24 bg-gray-100 rounded-full overflow-hidden hidden sm:block">
                                <div class="h-full rounded-full transition-all duration-500
                                    {{ $result->passed ? 'bg-emerald-400' : 'bg-red-400' }}"
                                    style="width: {{ $result->percentage }}%">
                                </div>
                            </div>
                            <span class="text-sm font-bold tabular-nums w-12 text-right
                                {{ $result->passed ? 'text-emerald-600' : 'text-red-500' }}">
                                {{ $result->percentage }}%
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @else
        <div class="bg-white rounded-2xl border border-dashed border-gray-200 p-10 text-center">
            <div class="w-14 h-14 bg-gray-50 rounded-2xl flex items-center justify-center mx-auto mb-4">
                <svg class="w-7 h-7 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
            </div>
            <p class="text-gray-500 text-sm font-medium">No quiz attempts yet</p>
            <p class="text-gray-400 text-xs mt-1">Take your first quiz to see results here</p>
        </div>
    @endif

</x-layouts.app>