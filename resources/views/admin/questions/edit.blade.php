<x-layouts.admin>
    <x-slot name="title">Edit Question</x-slot>

    <div class="mb-6">
        <a href="{{ route('admin.questions.index') }}" class="text-sm text-indigo-600 hover:underline">← Back to Questions</a>
        <h1 class="text-2xl font-bold text-gray-800 mt-2">Edit Question</h1>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 max-w-2xl">
        <form method="POST" action="{{ route('admin.questions.update', $question) }}">
            @csrf
            @method('PUT')

            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Question</label>
                <textarea name="body" rows="3"
                          class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition resize-none @error('body') border-red-400 @enderror"
                          placeholder="Enter your question here...">{{ old('body', $question->body) }}</textarea>
                @error('body')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-2">
                <div class="flex items-center justify-between mb-3">
                    <label class="text-sm font-medium text-gray-700">Answer Choices</label>
                    <button type="button" onclick="addChoice()"
                            class="text-xs text-indigo-600 hover:text-indigo-800 font-medium transition-colors">
                        + Add Choice
                    </button>
                </div>

                @error('choices')
                    <p class="mb-2 text-xs text-red-600">{{ $message }}</p>
                @enderror

                <div id="choices-container" class="space-y-3">
                    @php $existingChoices = old('choices', $question->choices->toArray()); @endphp
                    @foreach ($existingChoices as $i => $choice)
                        <div class="flex items-center gap-3 choice-row">
                            <input type="text" name="choices[{{ $i }}][body]"
                                   value="{{ $choice['body'] ?? '' }}"
                                   placeholder="Choice"
                                   class="flex-1 px-4 py-2.5 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition text-sm">
                            <label class="flex items-center gap-1.5 text-sm text-gray-600 shrink-0 cursor-pointer">
                                <input type="checkbox" name="choices[{{ $i }}][is_correct]"
                                       {{ ($choice['is_correct'] ?? false) ? 'checked' : '' }}
                                       class="rounded text-green-500 focus:ring-green-400">
                                Correct
                            </label>
                            <button type="button" onclick="this.closest('.choice-row').remove()"
                                    class="text-red-400 hover:text-red-600 transition-colors shrink-0">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        </div>
                    @endforeach
                </div>
            </div>

            <p class="text-xs text-gray-400 mb-6">Mark at least one choice as correct.</p>

            <div class="flex items-center gap-3">
                <button type="submit"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-6 py-2.5 rounded-xl transition-colors">
                    Update Question
                </button>
                <a href="{{ route('admin.questions.index') }}"
                   class="text-gray-500 hover:text-gray-700 font-medium px-4 py-2.5 transition-colors">
                    Cancel
                </a>
            </div>
        </form>
    </div>

    <script>
        let choiceIndex = {{ count(old('choices', $question->choices->toArray())) }};

        function addChoice() {
            const container = document.getElementById('choices-container');
            const div = document.createElement('div');
            div.className = 'flex items-center gap-3 choice-row';
            div.innerHTML = `
                <input type="text" name="choices[${choiceIndex}][body]"
                       placeholder="Choice"
                       class="flex-1 px-4 py-2.5 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition text-sm">
                <label class="flex items-center gap-1.5 text-sm text-gray-600 shrink-0 cursor-pointer">
                    <input type="checkbox" name="choices[${choiceIndex}][is_correct]"
                           class="rounded text-green-500 focus:ring-green-400">
                    Correct
                </label>
                <button type="button" onclick="this.closest('.choice-row').remove()"
                        class="text-red-400 hover:text-red-600 transition-colors shrink-0">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            `;
            container.appendChild(div);
            choiceIndex++;
        }
    </script>
</x-layouts.admin>