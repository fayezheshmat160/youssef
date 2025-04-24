<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Subject;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $questions = \App\Models\Question::inRandomOrder()->take(20)->get();
        //dd($questions);
        return view('student.student',compact('questions'));
    }

    public function toExam(){

        $totalQuestions = 20;
        $subjectIds = Subject::has('questions')->pluck('id')->toArray();
        $subjectCount = count($subjectIds);

        $basePerSubject = floor($totalQuestions / $subjectCount);
        $finalQuestions = collect();
        $totalCollected = 0;

// 1️⃣ Collect as much as we can per subject
        foreach ($subjectIds as $subjectId) {
            $availableCount = Question::where('subject_id', $subjectId)->count();
            $take = min($basePerSubject, $availableCount);

            $questions = Question::where('subject_id', $subjectId)
                ->inRandomOrder()
                ->take($take)
                ->get();

            $finalQuestions = $finalQuestions->merge($questions);
            $totalCollected += $questions->count();
        }

// 2️⃣ If total < 20, get the rest randomly from all remaining pool
        $remaining = $totalQuestions - $totalCollected;

        if ($remaining > 0) {
            $alreadyCollectedIds = $finalQuestions->pluck('id')->toArray();

            $extra = Question::whereNotIn('id', $alreadyCollectedIds)
                ->inRandomOrder()
                ->take($remaining)
                ->get();

            $finalQuestions = $finalQuestions->merge($extra);
        }

        $finalQuestions = $finalQuestions->shuffle(); // Optional: randomize full list again
        $questions = $finalQuestions;

        return view('student.exame' , compact('questions'));
    }


    public  function toSettings()
    {
        return view('student.settings.index');
    }
}
