<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubmitQuizRequest;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\QuizResult;
use App\Services\QuizScoreService;
use Illuminate\Support\Facades\Auth;

class QuizController extends Controller
{
    public function __construct(protected QuizScoreService $scoreService) {}

    public function index()
    {
        return view('student.quiz.index');
    }

    public function take()
    {
        $questions = Question::with('choices')->inRandomOrder()->take(15)->get();

        if ($questions->isEmpty()) {
            return back()->with('error', 'No questions available yet.');
        }

        $quiz = Quiz::create(['user_id' => Auth::id(), 'started_at' => now()]);

        return view('student.quiz.take', compact('questions', 'quiz'));
    }

    public function submit(SubmitQuizRequest $request, Quiz $quiz)
    {
        // Ensure quiz belongs to the authenticated user
        abort_if($quiz->user_id !== Auth::id(), 403);

        $answers = $request->answers;
        $questions = Question::with('choices')->whereIn('id', array_keys($answers))->get();

        [$score, $total] = $this->scoreService->calculate($questions, $answers);

        $quiz->update(['finished_at' => now()]);

        $result = QuizResult::create([
            'user_id' => Auth::id(),
            'quiz_id' => $quiz->id,
            'score' => $score,
            'total' => $total,
        ]);

        return redirect()->route('student.quiz.result', $result);
    }

    public function result(QuizResult $quizResult)
    {
        abort_if($quizResult->user_id !== Auth::id(), 403);

        return view('student.quiz.result', compact('quizResult'));
    }
}
