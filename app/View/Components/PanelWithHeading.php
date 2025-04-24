<?php

namespace App\View\Components;

use Illuminate\View\Component;

class PanelWithHeading extends Component
{

    public $title;
    public $class;
    public $body;

    public function __construct($title , $class = null, $body = null)
    {
        $this->title = $title;
        $this->class = $class;
        $this->body = $body;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.panel-with-heading');
    }
}
