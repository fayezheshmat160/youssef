<?php

namespace App\Http\Controllers;


class HomeController extends Controller
{

    public function index()
    {   
       
        echo "<a href=" . adminUrl('') . "> Go To Login Admin </a>";
    }
}
