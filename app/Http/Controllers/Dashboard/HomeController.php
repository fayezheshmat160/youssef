<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Dashboard\Emails;
use App\Models\Question;
use App\Models\Subject;


class HomeController extends Controller
{

    public function index()
    {
        $questionsCount = Question::count();
        $subjectsCount = Subject::count();
        // return redirect(adminUrl('books'));
        return view(pathPrefix() . 'home',compact('questionsCount', 'subjectsCount'));
    }

    public function getAllStudent(){
        return  view("dashboard.students.index");
    }
}
