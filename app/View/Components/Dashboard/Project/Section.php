<?php

namespace App\View\Components\Dashboard\Project;

use Illuminate\View\Component;

class Section extends Component
{
    // Section ID
    public string $id;

    // Important Input Values
    public $projectId = 0;

    // Form Action Url
    public $action;


    // Form Action Url
    public $section;


    // Buttons Next & Prev
    public $prev = null;

    public function __construct($id, $section, $projectId, $action, $prev = null)
    {
        $this->id        = $id;
        $this->section   = $section;
        $this->projectId = $projectId;
        $this->prev      = $prev;
        $this->action    = $action;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.dashboard.project.section');
    }
}
