<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Select extends Component
{
    public $label;
    public $name;

    public function __construct($label = false, $name = false)
    {
        $this->label = $label;
        $this->name = $name;
    }

    public function render()
    {
        return view('components.select');
    }
}
