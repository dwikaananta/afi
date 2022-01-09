<?php

namespace App\View\Components;

use App\Models\User;
use Illuminate\View\Component;

class UserIndex extends Component
{
    public function __construct()
    {
        //
    }

    public function render()
    {
        $user = User::get();

        return view('components.user-index', [
            'user' => $user
        ]);
    }
}
