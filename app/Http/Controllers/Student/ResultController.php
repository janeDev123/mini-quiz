<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\QuizResult;
use Illuminate\Support\Facades\Auth;

class ResultController extends Controller
{
    public function index()
    {
        $results = QuizResult::where('user_id', Auth::id())
            ->latest()
            ->paginate(15);

        return view('student.history.index', compact('results'));
    }
}
