<x-layouts.app>
    <x-slot name="title">Take a Quiz</x-slot>

    <div class="max-w-lg mx-auto text-center py-12">
        <div class="w-20 h-20 bg-indigo-100 rounded-3xl flex items-center justify-center mx-auto mb-6">
            <svg class="w-10 h-10 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
            </svg>
        </div>

        <h1 class="text-3xl font-bold text-gray-800 mb-3">Ready to Quiz?</h1>
        <p class="text-gray-500 mb-2">You'll be given <span class="font-semibold text-indigo-600">10 random questions</span>.</p>
        <p class="text-gray-500 mb-8">Answer as many as you can — a score of <span class="font-semibold text-green-600">60%</span> or above is a pass!</p>

        <form method="POST" action="{{ route('student.quiz.take') }}">
            @csrf
            <button type="submit"
                    class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white font-bold px-8 py-4 rounded-2xl text-lg transition-colors shadow-lg hover:shadow-xl">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Start Quiz
            </button>
        </form>

        <div class="mt-6">
            <a href="{{ route('student.dashboard') }}"
               class="text-sm text-gray-400 hover:text-gray-600 transition-colors">
                ← Back to Dashboard
            </a>
        </div>
    </div>
</x-layouts.app>