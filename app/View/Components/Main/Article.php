<?php

namespace App\View\Components\Main;

use Illuminate\View\Component;

class Article extends Component
{
    public $row;
    public $loop;


    public function __construct($data, $loop = null)
    {
        $this->row = $data;
        $this->loop = $loop;
    }

    public function render()
    {
        return view('components.main.article');
    }
}
