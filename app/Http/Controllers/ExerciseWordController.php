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
        $validated = $request->validate(['number' => 'required|integer|min:1|max:25' ],
        ['number.required'=> 'Выберите количество слов']);
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
            return redirect()->route('exercises.words.start', $exercise)
                ->with('message', 'Поздравляем, вы выучили все слова!');
        }

        session(['selectedWords' => $selectedWords, 'exerciseId' => $exercise->id]);

        return view('exercise.english-words.learn', compact('exercise', 'selectedWords'));
    }

    public function test(Request $request, Exercise $exercise){

        $words = session('selectedWords', []);

        if(empty($words)){
            return redirect()->route('exercises.words.start', $exercise)
                ->with('message', 'Ваша сессия устарела - начните упражнение заново.');
        }

        return view('exercise.english-words.test', compact('words', 'exercise'));
    }

    public function result(Request $request, Exercise $exercise){

        $user = auth()->user();
        $answers = $request->input('answers', []);

        $score = 0;
        $details = [];

        foreach($answers as $word => $userAnswer){
            $correctRu = collect($exercise->data)->firstWhere('word', $word)['translation'] ?? '';
            $isCorrect = mb_strtolower(trim($userAnswer)) === mb_strtolower($correctRu);

            $details[] = [
                'en' => $word,
                'ru' => $correctRu,
                'answer' => $userAnswer,
                'correct' => $isCorrect,
            ];
            if($isCorrect){
                $score++;
            }

        }
            $result = $user->exerciseResults()->create([
                'exercise_id' => $exercise->id,
                'score' => $score,
                'completed_at' => now(),
            ]);

        foreach($details as $detail){
             $result->words()->create([
                 'user_id' => $user->id,
                'exercise_id' => $exercise->id,
                'user_exercise_result_id' => $result->id,
                'word_en' => $detail['en'],
                'word_ru' => $detail['ru'],
                 'answer' => $detail['answer'],
                 'correct_answer' => $detail['correct'],
            ]);
        }

        session()->forget(['selectedWords', 'exerciseId']);
        $total = count($details);
        $percent = $total ? round($score / $total * 100) : 0;
        return view('exercise.english-words.result', compact('details', 'score', 'exercise', 'total', 'percent'));

    }



}
