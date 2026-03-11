<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreQuestionRequest;
use App\Models\Question;

class QuestionController extends Controller
{
    public function index()
    {
        $questions = Question::with('choices')->latest()->paginate(15);

        return view('admin.questions.index', compact('questions'));
    }

    public function create()
    {
        return view('admin.questions.create');
    }

    public function store(StoreQuestionRequest $request)
    {

        $question = Question::create(['body' => $request->body]);

        foreach ($request->choices as $choice) {
            $question->choices()->create([
                'body' => $choice['body'],
                'is_correct' => isset($choice['is_correct']),
            ]);
        }

        return redirect()->route('admin.questions.index')
            ->with('success', 'Question created successfully.');
    }

    public function edit(Question $question)
    {
        $question->load('choices');

        return view('admin.questions.edit', compact('question'));
    }

    public function update(StoreQuestionRequest $request, Question $question)
    {
        $question->update(['body' => $request->body]);

        $question->choices()->delete();

        foreach ($request->choices as $choice) {
            $question->choices()->create([
                'body' => $choice['body'],
                'is_correct' => isset($choice['is_correct']),
            ]);
        }

        return redirect()->route('admin.questions.index')
            ->with('success', 'Question updated successfully.');
    }

    public function destroy(Question $question)
    {
        $question->delete();

        return back()->with('success', 'Question deleted.');
    }
}
