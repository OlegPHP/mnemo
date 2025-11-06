<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Exercise;
use App\Models\User;
use App\Models\UserExerciseResult;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use App\Models\UserExercisePasswordResult;

class ExercisePasswordController extends Controller
{
    public function start(Exercise $exercise){
        return view('exercise.passwords.start', compact('exercise'));
    }

    public function learn(Request $request, Exercise $exercise){
        $validated = $request->validate(['number' => 'required|integer|min:1|max:10' ],
            ['number.required'=> 'Выберите количество паролей']);
        $number = $validated['number'];
        $userId = auth()->id();

        $allItems = $exercise->data;
        $useItems = UserExercisePasswordResult::where('user_id', $userId)
            ->where('exercise_id', $exercise->id)
            ->pluck('password')
            ->toArray();
        $unusedItems = array_filter($allItems,fn($w) =>
        !in_array($w, $useItems));
        $unusedItems = Arr::shuffle($unusedItems);
        $selectedItems = Arr::take($unusedItems, $number);

        if(empty($selectedItems)){
            return redirect()->route('exercises.passwords.start', $exercise)
                ->with('message', 'Поздравляем, вы выучили все пароли!');
        }

        session(['selectedItems' => $selectedItems, 'exerciseId' => $exercise->id]);

        return view('exercise.passwords.learn', compact('exercise', 'selectedItems'));
    }
}
