<x-layouts.app>
    <x-slot name="title">Quiz Result</x-slot>

    <div class="max-w-md mx-auto py-10">
        @php $passed = $quizResult->passed; @endphp

        {{-- Result Hero Card --}}
        <div class="relative overflow-hidden rounded-3xl p-8 mb-5 text-center shadow-2xl
            {{ $passed
                ? 'bg-gradient-to-br from-emerald-600 to-teal-700 shadow-emerald-900/20'
                : 'bg-gradient-to-br from-gray-900 to-gray-800 shadow-gray-900/20' }}">

            {{-- Blobs --}}
            <div class="absolute -top-8 -right-8 w-40 h-40 rounded-full blur-2xl pointer-events-none
                {{ $passed ? 'bg-white/10' : 'bg-red-500/10' }}"></div>
            <div class="absolute -bottom-8 -left-8 w-40 h-40 rounded-full blur-2xl pointer-events-none
                {{ $passed ? 'bg-emerald-300/10' : 'bg-orange-500/5' }}"></div>

            {{-- Badge Icon --}}
            <div class="relative w-20 h-20 mx-auto mb-5">
                <div class="absolute inset-0 rounded-2xl blur-md {{ $passed ? 'bg-white/20' : 'bg-red-500/20' }}"></div>
                <div class="relative w-20 h-20 rounded-2xl flex items-center justify-center
                    {{ $passed ? 'bg-white/20' : 'bg-red-500/20' }}">
                    @if ($passed)
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    @else
                        <svg class="w-10 h-10 text-red-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    @endif
                </div>
            </div>

            <h1 class="text-2xl font-extrabold text-white mb-1 tracking-tight">
                {{ $passed ? '🎉 You Passed!' : '😔 Not quite there!' }}
            </h1>
            <p class="text-sm mb-8 {{ $passed ? 'text-emerald-100' : 'text-gray-400' }}">
                {{ $passed ? 'Amazing work! Keep up the momentum.' : 'Review the topics and give it another shot.' }}
            </p>

            {{-- Big Score --}}
            <div class="text-7xl font-black text-white mb-1 tabular-nums tracking-tighter">
                {{ $quizResult->percentage }}<span class="text-4xl">%</span>
            </div>
            <p class="text-sm mb-6 {{ $passed ? 'text-emerald-200' : 'text-gray-400' }}">
                <span class="font-bold text-white">{{ $quizResult->score }}</span> out of
                <span class="font-bold text-white">{{ $quizResult->total }}</span> correct
            </p>

            {{-- Progress Bar --}}
            <div class="w-full bg-black/20 rounded-full h-3 mb-2 overflow-hidden">
                <div class="h-3 rounded-full transition-all duration-700
                    {{ $passed ? 'bg-white' : 'bg-red-400' }}"
                    style="width: {{ $quizResult->percentage }}%">
                </div>
            </div>
            <p class="text-xs {{ $passed ? 'text-emerald-200/70' : 'text-gray-600' }}">Passing score: 60%</p>
        </div>

        {{-- Action Buttons --}}
        <div class="grid grid-cols-2 gap-3 mb-3">
            <form method="POST" action="{{ route('student.quiz.take') }}" class="contents">
                @csrf
                <button type="submit"
                        class="inline-flex items-center justify-center gap-2 bg-gray-900 hover:bg-gray-800 text-white font-bold px-5 py-3.5 rounded-2xl transition-all duration-200 shadow-lg hover:-translate-y-0.5 text-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                    </svg>
                    Retake Quiz
                </button>
            </form>

            <a href="{{ route('student.history.index') }}"
               class="inline-flex items-center justify-center gap-2 bg-white hover:bg-gray-50 text-gray-800 font-bold px-5 py-3.5 rounded-2xl border border-gray-200 transition-all duration-200 shadow-sm hover:-translate-y-0.5 text-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                View History
            </a>
        </div>

        <div class="text-center">
            <a href="{{ route('student.dashboard') }}"
               class="inline-flex items-center gap-1.5 text-sm text-gray-400 hover:text-gray-700 font-medium transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Back to Dashboard
            </a>
        </div>

    </div>
</x-layouts.app>