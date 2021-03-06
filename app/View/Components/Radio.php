<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Radio extends Component
{
    public $inline;
    public $label;
    public $name;
    public $value;
    public $checked;
    public $placeholder;
    public $error;

    public function __construct($inline = false, $label = false, $name = false, $value = false, $checked = false, $placeholder = false, $error = false)
    {
        $this->inline = $inline;
        $this->label = $label;
        $this->name = $name;
        $this->value = $value;
        $this->checked = $checked;
        $this->placeholder = $placeholder;
        $this->error = $error;
    }

    public function render()
    {
        return view('components.radio');
    }
}
