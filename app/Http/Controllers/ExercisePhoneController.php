<?php

namespace App\Http\Controllers;

use App\Models\Exercise;
use Illuminate\Http\Request;
use App\Models\UserExercisePhoneResult;
use App\Models\User;
use App\Models\UserExerciseResult;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

class ExercisePhoneController extends Controller
{
    public function start(Exercise $exercise){
        return view('exercise.phones.start', compact('exercise'));
    }

    public function learn(Request $request, Exercise $exercise){
        $validated = $request->validate(['number' => 'required|integer|min:1|max:10' ],
            ['number.required'=> 'Выберите количество номеров']);
        $number = $validated['number'];
        $userId = auth()->id();

        $allItems = $exercise->data;
        $useItems = UserExercisePhoneResult::where('user_id', $userId)
            ->where('exercise_id', $exercise->id)
            ->pluck('number')
            ->toArray();
        $unusedItems = array_filter($allItems,fn($w) =>
        !in_array($w, $useItems));
        $unusedItems = Arr::shuffle($unusedItems);
        $selectedItems = Arr::take($unusedItems, $number);

        if(empty($selectedItems)){
            return redirect()->route('exercises.phones.start', $exercise)
                ->with('message', 'Поздравляем, вы выучили все номера!');
        }

        session(['selectedItems' => $selectedItems, 'exerciseId' => $exercise->id]);

        return view('exercise.phones.learn', compact('exercise', 'selectedItems'));
    }

    public function test(Request $request, Exercise $exercise){

        $items = session('selectedItems', []);

        if(empty($items)){
            return redirect()->route('exercises.phones.start', $exercise)
                ->with('message', 'Ваша сессия устарела - начните упражнение заново.');
        }

        return view('exercise.phones.test', compact('items', 'exercise'));
    }

    public function result(Request $request, Exercise $exercise){

        $user = auth()->user();
        $answers = $request->input('answers', []);

        $score = 0;
        $details = [];
        $i = 1;
        foreach($answers as $item => $userAnswer){

            $isCorrect = preg_replace('/\D/', '', $userAnswer) === preg_replace('/\D/', '', $item);

            $details[] = [
                'position' => $i++,
                'number' => $item,
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
            $result->phones()->create([
                'user_id' => $user->id,
                'exercise_id' => $exercise->id,
                'user_exercise_result_id' => $result->id,
                'position' => $detail['position'],
                'number' => $detail['number'],
                'answer' => $detail['answer'],
                'correct_answer' => $detail['correct'],
            ]);
        }

        session()->forget(['selectedItems', 'exerciseId']);
        $total = count($details);
        $percent = $total ? round($score / $total * 100) : 0;
        return view('exercise.phones.result', compact('details', 'score', 'exercise', 'total', 'percent'));

    }
}
