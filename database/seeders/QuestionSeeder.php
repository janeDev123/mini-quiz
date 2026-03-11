<?php

namespace Database\Seeders;

use App\Models\Question;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    public function run(): void
    {
        $questions = [
            [
                'body' => 'What is the capital of the Philippines?',
                'choices' => [
                    ['body' => 'Cebu City',    'is_correct' => false],
                    ['body' => 'Manila',        'is_correct' => true],
                    ['body' => 'Davao City',    'is_correct' => false],
                    ['body' => 'Quezon City',   'is_correct' => false],
                ],
            ],
            [
                'body' => 'What is 7 × 8?',
                'choices' => [
                    ['body' => '54', 'is_correct' => false],
                    ['body' => '56', 'is_correct' => true],
                    ['body' => '64', 'is_correct' => false],
                    ['body' => '48', 'is_correct' => false],
                ],
            ],
            [
                'body' => 'Which planet is known as the Red Planet?',
                'choices' => [
                    ['body' => 'Venus',   'is_correct' => false],
                    ['body' => 'Jupiter', 'is_correct' => false],
                    ['body' => 'Mars',    'is_correct' => true],
                    ['body' => 'Saturn',  'is_correct' => false],
                ],
            ],
            [
                'body' => 'What language is primarily used for web styling?',
                'choices' => [
                    ['body' => 'HTML', 'is_correct' => false],
                    ['body' => 'PHP',  'is_correct' => false],
                    ['body' => 'CSS',  'is_correct' => true],
                    ['body' => 'SQL',  'is_correct' => false],
                ],
            ],
            [
                'body' => 'What does HTML stand for?',
                'choices' => [
                    ['body' => 'Hyper Text Markup Language',    'is_correct' => true],
                    ['body' => 'High Tech Markup Language',     'is_correct' => false],
                    ['body' => 'Hyper Transfer Markup Language', 'is_correct' => false],
                    ['body' => 'Hyperlink Text Makeup Language', 'is_correct' => false],
                ],
            ],
            [
                'body' => 'Who is considered the father of the modern computer?',
                'choices' => [
                    ['body' => 'Alan Turing',   'is_correct' => true],
                    ['body' => 'Bill Gates',    'is_correct' => false],
                    ['body' => 'Steve Jobs',    'is_correct' => false],
                    ['body' => 'Linus Torvalds', 'is_correct' => false],
                ],
            ],
            [
                'body' => 'What is the largest ocean on Earth?',
                'choices' => [
                    ['body' => 'Atlantic Ocean', 'is_correct' => false],
                    ['body' => 'Indian Ocean',   'is_correct' => false],
                    ['body' => 'Arctic Ocean',   'is_correct' => false],
                    ['body' => 'Pacific Ocean',  'is_correct' => true],
                ],
            ],
            [
                'body' => 'Which framework is maintained by Laravel?',
                'choices' => [
                    ['body' => 'Symfony',  'is_correct' => false],
                    ['body' => 'Laravel',  'is_correct' => true],
                    ['body' => 'CodeIgniter', 'is_correct' => false],
                    ['body' => 'CakePHP',  'is_correct' => false],
                ],
            ],
            [
                'body' => 'What is the boiling point of water in Celsius?',
                'choices' => [
                    ['body' => '90°C',  'is_correct' => false],
                    ['body' => '100°C', 'is_correct' => true],
                    ['body' => '110°C', 'is_correct' => false],
                    ['body' => '80°C',  'is_correct' => false],
                ],
            ],
            [
                'body' => 'Which data structure uses LIFO (Last In First Out)?',
                'choices' => [
                    ['body' => 'Queue',  'is_correct' => false],
                    ['body' => 'Stack',  'is_correct' => true],
                    ['body' => 'Array',  'is_correct' => false],
                    ['body' => 'Tree',   'is_correct' => false],
                ],
            ],
        ];

        foreach ($questions as $q) {
            $question = Question::create(['body' => $q['body']]);
            foreach ($q['choices'] as $choice) {
                $question->choices()->create($choice);
            }
        }
    }
}
