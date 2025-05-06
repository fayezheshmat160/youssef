<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subjects = Subject::latest()->get();
        return view('dashboard.subjects.index', compact('subjects'));
    }

    // Show create form
    public function create()
    {
        return view('dashboard.subjects.create');
    }

    // Store new subject
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:لفظي,كمي'
        ]);

        Subject::create($validated);

        return redirect()->route('subjects.index')
            ->with('success', 'تم إضافة المادة بنجاح');
    }

    // Show edit form
    public function edit(Subject $subject)
    {
        return view('dashboard.subjects.edit', compact('subject'));
    }

    // Update subject
    public function update(Request $request, Subject $subject)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:لفظي,كمي'
        ]);

        $subject->update($validated);

        return redirect()->route('subjects.index')
            ->with('success', 'تم تحديث المادة بنجاح');
    }

    // Delete subject
    public function destroy($id)
    {
       
        Subject::where('id',$id)->delete();

        return redirect()->route('subjects.index');
    }
}
