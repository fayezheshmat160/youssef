<?php

namespace App\Http\Controllers;

use App\Models\ExamResult;
use App\Models\Question;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    public function index()
    {
        $questions = \App\Models\Question::inRandomOrder()->take(20)->get();

        //dd(Auth::user());
        return view('student.student',compact('questions'));
    }

    public function toExam(){

        $allQuestions = $this->getBalancedQuestions();
        $allQuestions->each->load(['passage', 'subject']);

        $structuredQuestions = [];

        foreach ($allQuestions->groupBy('subject_id') as $subjectId => $questionsGroup) {
            $subject = $questionsGroup->first()->subject;

            $subjectData = [
                'subject' => $subject,
                'passages' => [],
                'standalone_questions' => [],
            ];

            foreach ($questionsGroup as $question) {
                if ($question->passage_id) {
                    $passageId = $question->passage_id;
                    if (!isset($subjectData['passages'][$passageId])) {
                        $subjectData['passages'][$passageId] = [
                            'passage' => $question->passage,
                            'questions' => [],
                        ];
                    }
                    $subjectData['passages'][$passageId]['questions'][] = $question;
                } else {
                    $subjectData['standalone_questions'][] = $question;
                }
            }

            $structuredQuestions[] = $subjectData;
        }

        return view('student.exame', compact('structuredQuestions'));

    }


    function getBalancedQuestions()
    {
        $totalVerbal = 60;
        $totalQuant = 60;

        $verbalSubjects = Subject::where('type', 'لفظي')->get();
        $quantSubjects  = Subject::where('type', 'كمي')->get();

        $verbalPerSubject = floor($totalVerbal / max($verbalSubjects->count(), 1));
        $quantPerSubject  = floor($totalQuant / max($quantSubjects->count(), 1));

        $questions = collect();

        foreach ($verbalSubjects as $subject) {
            $questions = $questions->merge(
                $this->getSubjectQuestions($subject, $verbalPerSubject)
            );
        }

        foreach ($quantSubjects as $subject) {
            $questions = $questions->merge(
                $this->getSubjectQuestions($subject, $quantPerSubject)
            );
        }

        return $questions->shuffle()->take(120);
    }


    function getSubjectQuestions($subject, $count)
    {
        $questions = collect();

        $includePassage = rand(0, 1); // عشوائي: نضم قطعة أو لا

        if ($includePassage) {
            $passage = $subject->passages()->inRandomOrder()->first();

            if ($passage) {
                $passageQuestions = $passage->questions()->inRandomOrder()->take(4)->get();

                $questions = $questions->merge($passageQuestions);

                $remaining = $count - $passageQuestions->count();

                if ($remaining > 0) {
                    $nonPassageQuestions = $subject->questions()
                        ->whereNull('passage_id')
                        ->inRandomOrder()
                        ->take($remaining)
                        ->get();

                    $questions = $questions->merge($nonPassageQuestions);
                }

                return $questions;
            }
        }

        // لو مفيش قطعة أو لم يتم تضمينها
        return $subject->questions()
            ->whereNull('passage_id')
            ->inRandomOrder()
            ->take($count)
            ->get();
    }



    public  function toSettings()
    {

        return view('student.settings.index');
    }

    public function updateProfile(Request $request)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . auth()->id(),
            'phone' => 'nullable|string|max:15',
        ]);

        $student = auth()->user();
        $student->name = $validated['name'];
        $student->email = $validated['email'];
        $student->phone = $validated['phone'] ?? $student->phone;
        $student->save();

        return back()->with('profile_success', 'Profile updated successfully!');
    }


    public function changePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        $student = auth()->user();

        if (!Hash::check($validated['current_password'], $student->password)) {
            return back()->withErrors(['current_password' => 'The current password is incorrect.']);
        }

        $student->password = Hash::make($validated['new_password']);
        $student->save();

        return back()->with('password_success', 'Password changed successfully!');
    }

    public function submitExam(Request $request)
    {

        $validated = $request->validate([
            'student_id' => 'required|exists:users,id',
            'verbal_score' => 'required|numeric',
            'quantitative_score' => 'required|numeric',
            'total_score' => 'required|numeric',
            'correct_count' => 'required|integer',
        ]);


        $validated['verbal_score'] =round(($validated['verbal_score']/60) * 100 ,2);
        $validated['quantitative_score'] =round(($validated['quantitative_score']/60) * 100 , 2);
        $validated['total_score'] =round(($validated['total_score']/120) * 100 , 2);

        $result = ExamResult::create([
            'student_id' => $validated['student_id'],
            'verbal_score' => $validated['verbal_score'],
            'quantitative_score' => $validated['quantitative_score'],
            'total_score' => $validated['total_score'],
            'correct_count' => $validated['correct_count'],
        ]);

        session([
            'verbal_score' => $result->verbal_score,
            'quantitative_score' => $result->quantitative_score,
            'total_score' => $result->total_score,
            'correct_count' => $result->correct_count,
            'message' => "تمت الإجابة على " . $result->correct_count . " أسئلة بشكل صحيح."
        ]);

        return response()->json([
            'success' => true,
            'redirect_url' => route('exam.result')
        ]);
    }

    public function showResult()
    {
        return view('student.exam_result', [
            'score' => session('score'),
            'total' => session('total'),
            'correct_count' => session('correct_count'),
            'message' => session('message'),
        ]);
    }


}
