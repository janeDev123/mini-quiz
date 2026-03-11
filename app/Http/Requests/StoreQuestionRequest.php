<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreQuestionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->role === 'admin';
    }

   public function rules(): array
{
    return [
        'body'                 => ['required', 'string', 'max:1000'],
        'choices'              => ['required', 'array', 'min:2', 'max:6'],
        'choices.*.body'       => ['required', 'string', 'max:500'],
        'choices.*.is_correct' => ['nullable'],  // ← tanggalin ang 'boolean', nullable lang
    ];
}

   public function withValidator($validator): void
{
    $validator->after(function ($validator) {
        $choices = $this->input('choices', []);
        $hasCorrect = collect($choices)->contains(
            fn($c) => !empty($c['is_correct'])
        );

        if (!$hasCorrect) {
            $validator->errors()->add('choices', 'At least one choice must be marked as correct.');
        }
    });
}
}