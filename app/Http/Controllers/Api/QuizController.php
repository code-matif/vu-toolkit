<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\QuizAnswer;

class QuizController extends Controller
{
    public function updateQuiz(Request $request)
    {
        $data = $request->input('data');

        $subjectId = $data['subject_id'];
        $questionText = trim($data['question']);
        $lowerQuestion = strtolower($questionText);

        // Find existing quiz
        $quiz = Quiz::where('subject_id', $subjectId)
            ->whereRaw('LOWER(question) = ?', [$lowerQuestion])
            ->first();

        if (!$quiz) {
            // Create new quiz
            $quiz = Quiz::create([
                'subject_id' => $subjectId,
                'question'   => $questionText,
                'latex'      => $data['latex'] ?? false,
                'tags'       => isset($data['tags']) ? json_encode($data['tags']) : null,
                'lessons'    => isset($data['lessons']) ? json_encode($data['lessons']) : null,
            ]);
        }

        // Existing answers (for duplicate checking)
        $existingAnswers = $quiz->answers()->get();

        foreach ($data['answers'] as $newAnswer) {
            $newText = trim($newAnswer['text']);
            $newImage = $newAnswer['image'] ?? null;
            $newHash = $newImage ? md5($newImage) : null;

            $alreadyExists = $existingAnswers->contains(function ($answer) use ($newText, $newHash) {
                $textMatch = strtolower(trim($answer->text)) === strtolower($newText);

                if ($answer->image_base64 && $newHash) {
                    $imageMatch = md5($answer->image_base64) === $newHash;
                } else {
                    $imageMatch = !$answer->image_base64 && !$newHash;
                }

                return $textMatch && $imageMatch;
            });

            if (!$alreadyExists) {
                // Save new answer
                QuizAnswer::create([
                    'quiz_id'      => $quiz->id,
                    'text'         => $newText,
                    'latex'        => $newAnswer['latex'] ?? false,
                    'image_base64' => $newImage,
                ]);
            }
        }

        return response()->json([
            'message' => 'Quiz saved or updated successfully!',
            'quiz_id' => $quiz->id,
        ], 201);
    }
}
