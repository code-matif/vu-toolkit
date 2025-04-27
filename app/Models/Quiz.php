<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\QuizAnswer;

class Quiz extends Model
{
    use HasFactory;
    protected $fillable = [
        'subject_id',
        'question',
        'latex',
        'tags',
        'lessons',
    ];

    protected $casts = [
        'tags' => 'array',
        'lessons' => 'array',
    ];
    public function answers()
    {
        return $this->hasMany(QuizAnswer::class);
    }
}
