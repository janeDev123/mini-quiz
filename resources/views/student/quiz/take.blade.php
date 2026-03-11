<x-layouts.app>
    <x-slot name="title">Quiz</x-slot>

    <div class="max-w-2xl mx-auto">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Quiz</h1>
            <span class="text-sm text-gray-500">{{ $questions->count() }} questions</span>
        </div>

        <form method="POST" action="{{ route('student.quiz.submit', $quiz) }}">
            @csrf

            <div class="space-y-6">
                @foreach ($questions as $index => $question)
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                        <div class="flex items-start gap-3 mb-4">
                            <span class="inline-flex items-center justify-center w-7 h-7 bg-indigo-100 text-indigo-700 rounded-lg text-sm font-bold shrink-0">
                                {{ $index + 1 }}
                            </span>
                            <p class="text-gray-800 font-medium leading-relaxed">{{ $question->body }}</p>
                        </div>

                        <div class="space-y-2 pl-10">
                            @foreach ($question->choices as $choice)
                                <label class="flex items-center gap-3 cursor-pointer group">
                                    <input type="radio"
                                           name="answers[{{ $question->id }}]"
                                           value="{{ $choice->id }}"
                                           class="w-4 h-4 text-indigo-600 focus:ring-indigo-500 border-gray-300">
                                    <span class="text-sm text-gray-700 group-hover:text-gray-900 transition-colors">
                                        {{ $choice->body }}
                                    </span>
                                </label>
                            @endforeach
                        </div>

                        @error("answers.{$question->id}")
                            <p class="mt-2 pl-10 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                @endforeach
            </div>

            <div class="mt-8 flex items-center justify-between">
                <a href="{{ route('student.quiz.index') }}"
                   class="text-sm text-gray-400 hover:text-gray-600 transition-colors">
                    ← Cancel
                </a>
                <button type="submit"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold px-8 py-3 rounded-2xl transition-colors shadow-md hover:shadow-lg"
                        onclick="return confirm('Submit quiz? You cannot change answers after submission.')">
                    Submit Answers
                </button>
            </div>
        </form>
    </div>
</x-layouts.app>