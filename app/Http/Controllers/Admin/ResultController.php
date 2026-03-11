<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\QuizResult;

class ResultController extends Controller
{
    public function index()
    {
        $results = QuizResult::with(['user', 'quiz'])
            ->latest()
            ->paginate(20);

        return view('admin.results.index', compact('results'));
    }
}