<x-layouts.app>
    <x-slot name="title">Quiz Result</x-slot>

    <div class="max-w-lg mx-auto text-center py-12">
        @php $passed = $quizResult->passed; @endphp

        <!-- Result Badge -->
        <div class="w-24 h-24 mx-auto mb-6 rounded-3xl flex items-center justify-center
            {{ $passed ? 'bg-green-100' : 'bg-red-100' }}">
            @if ($passed)
                <svg class="w-12 h-12 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            @else
                <svg class="w-12 h-12 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            @endif
        </div>

        <h1 class="text-3xl font-bold mb-2 {{ $passed ? 'text-green-600' : 'text-red-500' }}">
            {{ $passed ? '🎉 You Passed!' : '😔 Better luck next time!' }}
        </h1>

        <p class="text-gray-500 mb-8">
            {{ $passed ? 'Great job! Keep it up.' : 'Review the topics and try again.' }}
        </p>

        <!-- Score Card -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 mb-8">
            <div class="text-6xl font-black mb-2 {{ $passed ? 'text-green-600' : 'text-red-500' }}">
                {{ $quizResult->percentage }}%
            </div>

            <p class="text-gray-500 mb-4">
                You got <span class="font-bold text-gray-800">{{ $quizResult->score }}</span>
                out of <span class="font-bold text-gray-800">{{ $quizResult->total }}</span> correct
            </p>

            <!-- Progress Bar -->
            <div class="w-full bg-gray-100 rounded-full h-4">
                <div class="h-4 rounded-full transition-all duration-700
                    {{ $passed ? 'bg-green-500' : 'bg-red-400' }}"
                    style="width: {{ $quizResult->percentage }}%"></div>
            </div>

            <p class="mt-3 text-xs text-gray-400">Passing score: 60%</p>
        </div>

        <!-- Actions -->
        <div class="flex flex-col sm:flex-row items-center justify-center gap-3">
            <form method="POST" action="{{ route('student.quiz.take') }}">
                @csrf
                <button type="submit"
                        class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-6 py-3 rounded-xl transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                    </svg>
                    Retake Quiz
                </button>
            </form>

            <a href="{{ route('student.history.index') }}"
               class="inline-flex items-center gap-2 bg-white hover:bg-gray-50 text-gray-700 font-semibold px-6 py-3 rounded-xl border border-gray-200 transition-colors">
                View History
            </a>

            <a href="{{ route('student.dashboard') }}"
               class="inline-flex items-center gap-2 text-gray-400 hover:text-gray-600 font-medium px-4 py-3 transition-colors">
                Dashboard
            </a>
        </div>
    </div>
</x-layouts.app>