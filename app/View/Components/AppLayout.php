<?php

namespace App\View\Components;

use Illuminate\Http\Client\Request;
use Illuminate\View\Component;

class AppLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */

    public $title;

    public function __construct($titles) {
        $this->title = $titles;
      
    }

    public function render()
    {
        return view('layouts.app');
    }
}
