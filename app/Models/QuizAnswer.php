<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Quiz;

class QuizAnswer extends Model
{
    use HasFactory;

    protected $fillable = [
        'quiz_id', 'text', 'latex', 'image_base64',
    ];

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

}
