<?php

namespace App\View\Components;

use Illuminate\View\Component;

class DeleteAlert extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $message;
    public function __construct($data)
    {
        $this->message = $data;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.delete-alert');
    }
}
