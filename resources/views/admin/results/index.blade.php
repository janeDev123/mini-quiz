<x-layouts.admin>
    <x-slot name="title">Results</x-slot>

    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Student Results</h1>
        <p class="text-gray-500 text-sm mt-1">All quiz attempts across all students</p>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        @if ($results->isEmpty())
            <div class="text-center py-16 text-gray-400">
                <p class="font-medium">No quiz results yet.</p>
            </div>
        @else
            <table class="w-full text-sm">
                <thead class="bg-gray-50 border-b border-gray-100">
                    <tr class="text-left text-gray-500">
                        <th class="px-6 py-3 font-medium">Student</th>
                        <th class="px-6 py-3 font-medium">Score</th>
                        <th class="px-6 py-3 font-medium">Percentage</th>
                        <th class="px-6 py-3 font-medium">Status</th>
                        <th class="px-6 py-3 font-medium">Date</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @foreach ($results as $result)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 font-medium text-gray-800">{{ $result->user->name }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ $result->score }} / {{ $result->total }}</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <div class="flex-1 bg-gray-100 rounded-full h-2 w-24">
                                        <div class="h-2 rounded-full {{ $result->passed ? 'bg-green-500' : 'bg-red-400' }}"
                                             style="width: {{ $result->percentage }}%"></div>
                                    </div>
                                    <span class="text-gray-600 text-xs">{{ $result->percentage }}%</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold
                                    {{ $result->passed ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                    {{ $result->passed ? 'Passed' : 'Failed' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-gray-500">{{ $result->created_at->format('M d, Y h:i A') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="px-6 py-4 border-t border-gray-100">
                {{ $results->links() }}
            </div>
        @endif
    </div>
</x-layouts.admin>