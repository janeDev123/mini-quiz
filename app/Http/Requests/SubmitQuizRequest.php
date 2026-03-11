<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubmitQuizRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->role === 'student';
    }

    public function rules(): array
    {
        return [
            'answers'   => ['required', 'array'],
            'answers.*' => ['required', 'integer', 'exists:choices,id'],
        ];
    }
}