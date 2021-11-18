<?php

namespace App\View\Components;

use Illuminate\View\Component;

class MenuItem extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $name;
    public $class;
    public $link;
    public $count;
    public function __construct($name,$class,$link='',$count='0')
    {
        $this->name = $name;
        $this->class = $class;
        $this->link = $link;
        $this->count = $count;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.menu-item');
    }
}
