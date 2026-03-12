<x-layouts.app>
    <x-slot name="title">Quiz</x-slot>

    <div class="max-w-2xl mx-auto">

        {{-- Header --}}
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-2xl font-extrabold text-gray-900 tracking-tight">Quiz Time</h1>
                <p class="text-sm text-gray-400 mt-0.5 font-medium">Answer all questions below</p>
            </div>
            <div class="flex items-center gap-2 bg-gray-900 text-white px-4 py-2 rounded-xl shadow">
                <svg class="w-4 h-4 text-violet-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span class="text-sm font-bold tabular-nums">{{ $questions->count() }}</span>
                <span class="text-gray-400 text-xs font-medium">questions</span>
            </div>
        </div>

        <form method="POST" action="{{ route('student.quiz.submit', $quiz) }}" id="quiz-form">
            @csrf

            <div class="space-y-5">
                @foreach ($questions as $index => $question)
                    <div class="group bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-md hover:border-gray-200 transition-all duration-200 overflow-hidden">

                        {{-- Question Header --}}
                        <div class="flex items-start gap-3 p-5 pb-4">
                            <span class="inline-flex items-center justify-center w-7 h-7 bg-gray-900 text-white rounded-lg text-xs font-black shrink-0 mt-0.5">
                                {{ $index + 1 }}
                            </span>
                            <p class="text-gray-800 font-semibold leading-relaxed text-sm sm:text-base">{{ $question->body }}</p>
                        </div>

                        {{-- Divider --}}
                        <div class="mx-5 h-px bg-gray-50"></div>

                        {{-- Choices --}}
                        <div class="p-4 space-y-2">
                            @foreach ($question->choices as $choice)
                                <label class="flex items-center gap-3 cursor-pointer group/choice rounded-xl px-3 py-2.5 hover:bg-gray-50 transition-colors border border-transparent has-[:checked]:bg-violet-50 has-[:checked]:border-violet-200">
                                    <input type="radio"
                                           name="answers[{{ $question->id }}]"
                                           value="{{ $choice->id }}"
                                           class="w-4 h-4 text-violet-600 focus:ring-violet-500 focus:ring-offset-0 border-gray-300 shrink-0">
                                    <span class="text-sm text-gray-600 group-hover/choice:text-gray-900 transition-colors font-medium">
                                        {{ $choice->body }}
                                    </span>
                                </label>
                            @endforeach
                        </div>

                        @error("answers.{$question->id}")
                            <div class="mx-5 mb-4 flex items-center gap-2 bg-red-50 border border-red-100 text-red-600 text-xs font-semibold px-3 py-2 rounded-lg">
                                <svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                </svg>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                @endforeach
            </div>

            {{-- Footer Actions --}}
            <div class="mt-8 flex items-center justify-between">
                <a href="{{ route('student.quiz.index') }}"
                   class="inline-flex items-center gap-1.5 text-sm text-gray-400 hover:text-gray-700 font-medium transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                    Cancel
                </a>

                <button type="button"
                        onclick="confirmSubmit()"
                        class="inline-flex items-center gap-2.5 bg-gray-900 hover:bg-gray-800 text-white font-bold px-7 py-3.5 rounded-2xl transition-all duration-200 shadow-lg shadow-gray-900/20 hover:shadow-gray-900/30 hover:-translate-y-0.5 active:translate-y-0">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Submit Answers
                </button>
            </div>
        </form>
    </div>

    {{-- Confirm Modal --}}
    <div id="confirm-modal" class="hidden" style="position:fixed;inset:0;z-index:9999;display:none;align-items:center;justify-content:center;padding:1rem;">
        <div class="absolute inset-0 bg-black/40 backdrop-blur-sm" onclick="closeModal()" style="position:fixed;inset:0;"></div>
        <div class="relative bg-white rounded-3xl shadow-2xl p-8 max-w-sm w-full text-center" style="position:relative;z-index:10000;">
            <div class="w-14 h-14 bg-amber-50 rounded-2xl flex items-center justify-center mx-auto mb-4">
                <svg class="w-7 h-7 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
            </div>
            <h2 class="text-xl font-extrabold text-gray-900 mb-2">Submit Quiz?</h2>
            <p class="text-sm text-gray-500 mb-6 leading-relaxed">You can't change your answers after submitting. Make sure you've answered everything!</p>
            <div class="flex gap-3">
                <button onclick="closeModal()"
                        class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold px-4 py-3 rounded-xl transition-colors text-sm">
                    Go Back
                </button>
                <button onclick="document.getElementById('quiz-form').submit()"
                        class="flex-1 bg-gray-900 hover:bg-gray-800 text-white font-bold px-4 py-3 rounded-xl transition-colors text-sm shadow-lg">
                    Yes, Submit
                </button>
            </div>
        </div>
    </div>

    <script>
        function confirmSubmit() {
            const modal = document.getElementById('confirm-modal');
            modal.style.display = 'flex';
        }
        function closeModal() {
            const modal = document.getElementById('confirm-modal');
            modal.style.display = 'none';
        }
    </script>

</x-layouts.app>