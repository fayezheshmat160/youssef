<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Questions\QuestionsCategory;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class QuestionsController extends Controller
{

    public function getAllQuestions()
        {
        $questions = Question::with('subject')->get();;
        return view('dashboard.questions.index', compact('questions'));
        }

     public function create()
    {
        $subjects = Subject::all();
        return view('dashboard.questions.create', compact('subjects'));
    }
    public function store(Request $request)
    {
        
        $data = $request->validate([
            'subject_id' => 'required|exists:subjects,id',
            'question' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'correct_answer' => 'required|in:a,b,c,d', // لازم تكون واحدة من الأربعة
            'explane_answer' => 'required|string',
            'notes' => 'nullable|string',
            'option_a' => 'required|string',
            'option_b' => 'required|string',
            'option_c' => 'required|string',
            'option_d' => 'required|string',
        ]);
   
    
        $data['options'] = json_encode([
            'a' => $request->option_a,
            'b' => $request->option_b,
            'c' => $request->option_c,
            'd' => $request->option_d,
        ]);
        
    
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('questions_photos', 'public');
        }
    
        Question::create($data);
        
         
        return redirect()->route('questions.getAllQuestions')->with('success', 'Question created successfully!');
    }
    
    public function edit(Question $question)
    {
        $subjects = \App\Models\Subject::all();
        return view('dashboard.questions.edit', compact('question', 'subjects'));
    }

    public function update(Request $request, Question $question)
{
    $data = $request->validate([
        'subject_id' => 'required|exists:subjects,id',
        'question' => 'required|string',
        'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        'correct_answer' => 'required|in:a,b,c,d',
        'explane_answer' => 'required|string',
        'notes' => 'nullable|string',
        'option_a' => 'required|string',
        'option_b' => 'required|string',
        'option_c' => 'required|string',
        'option_d' => 'required|string',
    ]);

    $data['options'] = json_encode([
        'a' => $request->option_a,
        'b' => $request->option_b,
        'c' => $request->option_c,
        'd' => $request->option_d,
    ]);

    if ($request->hasFile('photo')) {
        // Delete the old photo if exists
        if ($question->photo) {
            Storage::disk('public')->delete($question->photo);
        }

        $data['photo'] = $request->file('photo')->store('questions_photos', 'public');
    }

    $question->update($data);

    
    return redirect()->route('questions.getAllQuestions')->with('success', 'Question updated successfully!');
}
    
    
    public function destroy(Question $question)
    {
        if ($question->photo) {
            Storage::disk('public')->delete($question->photo);
        }

        $question->delete();
        return redirect()->route('questions.getAllQuestions')->with('success', 'Question Deleted successfully!');

    }

   
}
