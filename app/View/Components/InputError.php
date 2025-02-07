<?php
// app/View/Components/InputError.php

namespace App\View\Components;

use Illuminate\View\Component;

class InputError extends Component
{
    public $messages;

    public function __construct($messages)
    {
        $this->messages = $messages;
    }

    public function render()
    {
        return view('components.input-error');
    }
}