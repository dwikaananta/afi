<?php

namespace App\View\Components;

use Illuminate\View\Component;

class BtnSwitchStatus extends Component
{
    public $url;
    public $title;

    public function __construct($url = false, $title = false)
    {
        $this->url = $url;
        $this->title = $title;
    }

    public function render()
    {
        return view('components.btn-switch-status');
    }
}
