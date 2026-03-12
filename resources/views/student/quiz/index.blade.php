<x-layouts.app>
    <x-slot name="title">Take a Quiz</x-slot>

    <div class="max-w-md mx-auto py-10">

        {{-- Hero Card --}}
        <div class="relative overflow-hidden bg-gray-900 rounded-3xl p-8 mb-5 shadow-2xl shadow-gray-900/20 text-center">
            {{-- Decorative blobs --}}
            <div class="absolute -top-10 -right-10 w-48 h-48 bg-violet-600/20 rounded-full blur-2xl pointer-events-none"></div>
            <div class="absolute -bottom-10 -left-10 w-48 h-48 bg-indigo-500/20 rounded-full blur-2xl pointer-events-none"></div>

            {{-- Icon --}}
            <div class="relative w-20 h-20 mx-auto mb-6">
                <div class="absolute inset-0 bg-violet-500/30 rounded-2xl blur-md"></div>
                <div class="relative w-20 h-20 bg-gradient-to-br from-violet-500 to-indigo-600 rounded-2xl flex items-center justify-center shadow-lg">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                              d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                    </svg>
                </div>
            </div>

            <h1 class="text-3xl font-extrabold text-white mb-2 tracking-tight">Ready to Quiz?</h1>
            <p class="text-gray-400 text-sm leading-relaxed mb-6">
                Answer as many as you can. Score <span class="font-bold text-emerald-400">60% or above</span> to pass!
            </p>

            {{-- Stats row --}}
            <div class="flex items-center justify-center gap-6 mb-8">
                <div class="text-center">
                    <p class="text-2xl font-black text-white">60%</p>
                    <p class="text-xs text-gray-500 font-medium mt-0.5">Passing</p>
                </div>
                <div class="w-px h-8 bg-gray-700"></div>
                <div class="text-center">
                    <p class="text-2xl font-black text-white">∞</p>
                    <p class="text-xs text-gray-500 font-medium mt-0.5">Attempts</p>
                </div>
                <div class="w-px h-8 bg-gray-700"></div>
                <div class="text-center">
                    <p class="text-2xl font-black text-white">🏆</p>
                    <p class="text-xs text-gray-500 font-medium mt-0.5">Track Score</p>
                </div>
            </div>

            {{-- CTA Button --}}
            <form method="POST" action="{{ route('student.quiz.take') }}">
                @csrf
                <button type="submit"
                        class="group relative w-full inline-flex items-center justify-center gap-2.5 bg-violet-600 hover:bg-violet-500 text-white font-bold px-8 py-4 rounded-2xl text-base transition-all duration-200 shadow-lg shadow-violet-900/40 hover:shadow-violet-900/60 hover:-translate-y-0.5 active:translate-y-0">
                    <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Start Quiz
                </button>
            </form>
        </div>

        {{-- Back link --}}
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