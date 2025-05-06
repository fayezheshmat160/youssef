<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Passage;
use App\Models\Question;
use App\Models\Subject;
use Illuminate\Support\Facades\DB;

class AdminPassageController extends Controller
{

    public function index()
    {
        $passages = Passage::with('subject')->latest()->paginate(10);
        return view('dashboard.passages.index', compact('passages'));
    }

    public function create()
    {

        $subjects = Subject::all();
        return view('dashboard.passages.create', compact('subjects'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'content' => 'required|string',
            'type' => 'required|in:لفظي,كمي',
            'subject_id' => 'nullable|exists:subjects,id',
        ]);

        DB::transaction(function () use ($request, $validated) {
            $passage = Passage::create($validated);

            foreach ($request->questions as $qData) {
                $question = new Question();
                $question->subject_id = $validated['subject_id'];
                $question->type = $validated['type'];
                $question->question = $qData['question'];

                if (isset($qData['photo'])) {
                    $question->photo = $qData['photo']->store('questions', 'public');
                }

                $question->options = json_encode($qData['options']);
                $question->correct_answer = $qData['correct_answer'];
                $question->explane_answer = $qData['explane_answer'] ?? '';
                $question->notes = $qData['notes'] ?? null;
                $question->passage_id = $passage->id;

                $question->save();
            }
        });

        return redirect()->route('passages.create')->with('success', 'تم حفظ القطعة والأسئلة بنجاح');
    }

    // public function edit($id)
    // {
    //     $passage = Passage::with('questions')->findOrFail($id);
    //     $subjects = Subject::all();
    //     return view('dashboard.passages.edit', compact('passage', 'subjects'));
    // }

    // public function update(Request $request, $id)
    // {
    //     $validated = $request->validate([
    //         'title' => 'required|string',
    //         'content' => 'required|string',
    //         'type' => 'required|in:لفظي,كمي',
    //         'subject_id' => 'nullable|exists:subjects,id',
    //     ]);

    //     $passage = Passage::findOrFail($id);
    //     $passage->update($validated);

    //     return redirect()->route('passages.index')->with('success', 'تم تعديل القطعة بنجاح');
    // }

    public function edit($id)
{
    $passage = Passage::with('questions')->findOrFail($id);
    $subjects = Subject::all();

    return view('dashboard.passages.edit', compact('passage', 'subjects'));
}

public function update(Request $request, $id)
{
    $validated = $request->validate([
        'title' => 'required|string',
        'content' => 'required|string',
        'type' => 'required|in:لفظي,كمي',
        'subject_id' => 'nullable|exists:subjects,id',
    ]);

    DB::transaction(function () use ($request, $validated, $id) {
        $passage = Passage::findOrFail($id);
        $passage->update($validated);

        // حذف كل الأسئلة القديمة المرتبطة بالقطعة
        $passage->questions()->delete();

        // إعادة إضافة الأسئلة الجديدة
        foreach ($request->questions as $qData) {
            $question = new Question();
            $question->subject_id = $validated['subject_id'];
            $question->type = $validated['type'];
            $question->question = $qData['question'];

            if (isset($qData['photo']) && $qData['photo'] instanceof \Illuminate\Http\UploadedFile) {
                $question->photo = $qData['photo']->store('questions', 'public');
            }

            $question->options = json_encode($qData['options']);
            $question->correct_answer = $qData['correct_answer'];
            $question->explane_answer = $qData['explane_answer'] ?? '';
            $question->notes = $qData['notes'] ?? null;
            $question->passage_id = $passage->id;

            $question->save();
        }
    });

    return redirect()->route('passages.index')->with('success', 'تم تحديث القطعة والأسئلة بنجاح');
}
    public function destroy($id)
    {
        $passage = Passage::findOrFail($id);
        $passage->delete();

        return redirect()->route('passages.index')->with('success', 'تم حذف القطعة بنجاح');
    }
}
