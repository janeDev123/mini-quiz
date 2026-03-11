<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizResult extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'quiz_id', 'score', 'total'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

    public function getPercentageAttribute(): float
    {
        return $this->total > 0 ? round(($this->score / $this->total) * 100, 2) : 0;
    }

    public function getPassedAttribute(): bool
    {
        return $this->percentage >= 60;
    }
}
