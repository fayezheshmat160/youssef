<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Dashboard\Emails;
use App\Models\Question;
use App\Models\Subject;
use App\Models\Dashboard\admin\Admin;


class HomeController extends Controller
{

    public function index()
    {
        $questionsCount = Question::count();
        $subjectsCount = Subject::count();
        $admin = auth('admin')->user();

      
        // return redirect(adminUrl('books'));
        return view(pathPrefix() . 'home',compact('questionsCount', 'subjectsCount','admin'));
    }

    public function getAllStudent(){
        return  view("dashboard.students.index");
    }
}
