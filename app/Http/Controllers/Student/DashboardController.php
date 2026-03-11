<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\QuizResult;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user         = Auth::user();
        $totalAttempts = QuizResult::where('user_id', $user->id)->count();
        $bestScore     = QuizResult::where('user_id', $user->id)->max('score');
        $recentResults = QuizResult::where('user_id', $user->id)
            ->latest()
            ->take(5)
            ->get();

        return view('student.dashboard', compact('totalAttempts', 'bestScore', 'recentResults'));
    }
}