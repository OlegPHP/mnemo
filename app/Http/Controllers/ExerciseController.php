<?php

namespace App\Http\Controllers;

use App\Models\Exercise;
use App\Models\Theory;
use Illuminate\Http\Request;
use App\Models\UserExercisePasswordResult;
use App\Models\UserExercisePhoneResult;
use App\Models\UserExerciseListResult;
use App\Models\UserExerciseWordResult;
use App\Models\UserExerciseResult;

class ExerciseController extends Controller
{
    public function index()
    {
        $exercises = Exercise::all();
        return view('exercise.index', compact('exercises'));
    }

    public function show(Exercise $exercise)
    {


        return view('exercise.show', compact('exercise'));
    }



        public function result()
        {
            $user = auth()->user();

            // Загружаем коллекции результатов по каждому типу
            $resultsWord = $user->exerciseWordResults()->latest()->get();
            $resultsPhone = $user->exercisePhoneResults()->latest()->get();
            $resultsPassword = $user->exercisePasswordResults()->latest()->get();
            $resultsList = $user->exerciseListResults()->latest()->get();

            // Универсальная функция расчёта статистики по типу

            $statMaster = function ($results){
                $count = $results->count();
                $correct = $results->where('correct_answer', true)->count();
                $accuracy = $count > 0 ? round($correct / $count*100, 1) : 0;
                $latest = optional($results->first())->created_at;

                return [
                    'count' => $count,
                    'correct' => $correct,
                    'accuracy' => $accuracy,
                    'latest' => $latest,
                ];


            };

            //Пропускаем каждую коллекцию через функцию

            $stats = [
                'words' => $statMaster($resultsWord),
                'list' => $statMaster($resultsList),
                'phones' => $statMaster($resultsPhone),
                'passwords' => $statMaster($resultsPassword),
            ];

            $existStats = array_filter($stats, function ($stat) {
              return  $stat['count'] > 0;
            });
            $totalAverage = $existStats ? round(array_sum(array_column($existStats, 'accuracy')) / count($existStats)) : 0;


            return view('exercise.result', compact('stats', 'totalAverage'));
        }

            public function resultType($type){

                $user = auth()->user();


                if($type == 'words'){
                    $results = $user->exerciseWordResults()->oldest()->get();
                }elseif ($type == 'list'){
                    $results = $user->exerciseListResults()->oldest()->get();
                }elseif ($type == 'phones'){
                    $results = $user->exercisePhoneResults()->oldest()->get();
                }elseif ($type == 'passwords'){
                    $results = $user->exercisePasswordResults()->oldest()->get();
                }
                $exerciseId = optional($results->first())->exercise_id;
                $total = $exerciseId ? $user->exerciseResults()->where('exercise_id', $exerciseId)->count() : 0 ;

                $grouped = $results->groupBy('user_exercise_result_id');




                return view("exercise.results.$type", compact( 'total','exerciseId', 'grouped'));

            }

    public function resetResult($type)
    {
        $user = auth()->user();

        match ($type) {
            'words' => $user->exerciseWordResults()->delete(),
            'list' => $user->exerciseListResults()->delete(),
            'phones' => $user->exercisePhoneResults()->delete(),
            'passwords' => $user->exercisePasswordResults()->delete(),
            default => null,
        };

        return redirect()->back()->with('success', 'Статистика успешно сброшена.');
    }


}

