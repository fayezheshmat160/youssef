<?php

namespace App\Http\Controllers;

use App\Models\Dashboard\Books;
use App\Models\Dashboard\Messages;

class MessagesController extends Controller
{


    // Blog Display All Articles
    public function index()
    {

        $q = request('q');


        $share = request('share');

        // Get Articles
        $rows = Messages::orderbyDesc('id')->where('normalize_name', 'like', "%" . normalizeName($q) . "%");

        if ($share == 'no') {
            $rows = $rows->where('have_book', '0');
        } else {
            $rows = $rows->where('have_book',  '1');
        }

        $rows = $rows->paginate(24);

        return view('main.messages', compact('rows', 'q'));
    }
}
