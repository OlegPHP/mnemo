<?php

namespace App\Http\Controllers;

use App\Models\Exercise;
use App\Models\User;
use App\Models\UserExerciseResult;
use App\Models\UserExerciseWordResult;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

class ExerciseWordController extends Controller
{
    public function start(Exercise $exercise){
        return view('exercise.english-words.start', compact('exercise'));
    }

    public function learn(Request $request, Exercise $exercise){
        $validated = $request->validate(['number' => 'required|integer|min:1|max:25' ]);
        $number = $validated['number'];
        $userId = auth()->id();

        $allWords = $exercise->data;
        $useWords = UserExerciseWordResult::where('user_id', $userId)
            ->where('exercise_id', $exercise->id)
            ->pluck('word_en')
            ->toArray();
        $unusedWords = array_filter($allWords,fn($w) =>
            !in_array($w['word'], $useWords));
        $unusedWords = Arr::shuffle($unusedWords);
        $selectedWords = Arr::take($unusedWords, $number);

        if(empty($selectedWords)){
            return redirect()->route('exercise.start', $exercise)
                ->with('message', 'Поздравляем, вы выучили все слова!');
        }

        session(['selectedWords' => $selectedWords, 'exerciseId' => $exercise->id]);

        return view('exercise.english-words.learn', compact('exercise', 'selectedWords'));
    }
}
