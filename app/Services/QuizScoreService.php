<?php

namespace App\Services;

use Illuminate\Support\Collection;

class QuizScoreService
{
    /**
     * Calculate the score for a quiz attempt.
     *
     * @param  Collection  $questions
     * @param  array       $answers  [question_id => choice_id]
     * @return array       [$score, $total]
     */
    public function calculate(Collection $questions, array $answers): array
    {
        $score = 0;
        $total = $questions->count();

        foreach ($questions as $question) {
            $selectedChoiceId = $answers[$question->id] ?? null;

            if ($selectedChoiceId) {
                $correct = $question->choices->firstWhere('is_correct', true);
                if ($correct && (int) $selectedChoiceId === $correct->id) {
                    $score++;
                }
            }
        }

        return [$score, $total];
    }
}