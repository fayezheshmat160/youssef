<?php

namespace App\View\Components\Dashboard;

use Illuminate\Support\Str;
use Illuminate\View\Component;

class SEO extends Component
{
    public $browserPreview;

    public $values = [];

    public function __construct($browserPreview = false, $values = [])
    {
        $this->browserPreview = $browserPreview;

        $this->values = $values;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.dashboard.seo');
    }
}
