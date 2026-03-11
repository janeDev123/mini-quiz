<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\QuizResult;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $totalStudents  = User::where('role', 'student')->count();
        $totalQuestions = Question::count();
        $totalResults   = QuizResult::count();
        $recentResults  = QuizResult::with('user')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalStudents',
            'totalQuestions',
            'totalResults',
            'recentResults'
        ));
    }
}