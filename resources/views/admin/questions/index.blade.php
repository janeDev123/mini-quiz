<x-layouts.admin>
    <x-slot name="title">Questions</x-slot>

    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Questions</h1>
            <p class="text-gray-500 text-sm mt-1">Manage all quiz questions</p>
        </div>
        <a href="{{ route('admin.questions.create') }}"
           class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2.5 rounded-xl text-sm font-semibold transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Add Question
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        @if ($questions->isEmpty())
            <div class="text-center py-16 text-gray-400">
                <svg class="w-12 h-12 mx-auto mb-3 opacity-40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                          d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01"/>
                </svg>
                <p class="font-medium">No questions yet.</p>
                <p class="text-sm">Click "Add Question" to get started.</p>
            </div>
        @else
            <table class="w-full text-sm">
                <thead class="bg-gray-50 border-b border-gray-100">
                    <tr class="text-left text-gray-500">
                        <th class="px-6 py-3 font-medium">#</th>
                        <th class="px-6 py-3 font-medium">Question</th>
                        <th class="px-6 py-3 font-medium">Choices</th>
                        <th class="px-6 py-3 font-medium text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @foreach ($questions as $question)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 text-gray-400 font-mono text-xs">{{ $question->id }}</td>
                            <td class="px-6 py-4 text-gray-800 font-medium max-w-md">
                                <p class="truncate">{{ $question->body }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <div class="space-y-0.5">
                                    @foreach ($question->choices as $choice)
                                        <span class="inline-flex items-center gap-1 text-xs px-2 py-0.5 rounded-full
                                            {{ $choice->is_correct ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600' }}">
                                            @if ($choice->is_correct)
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                                </svg>
                                            @endif
                                            {{ Str::limit($choice->body, 25) }}
                                        </span>
                                    @endforeach
                                </div>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.questions.edit', $question) }}"
                                       class="text-indigo-600 hover:text-indigo-800 text-xs font-medium transition-colors">
                                        Edit
                                    </a>
                                    <form method="POST" action="{{ route('admin.questions.destroy', $question) }}"
                                          onsubmit="return confirm('Delete this question?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="text-red-500 hover:text-red-700 text-xs font-medium transition-colors">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="px-6 py-4 border-t border-gray-100">
                {{ $questions->links() }}
            </div>
        @endif
    </div>
</x-layouts.admin>