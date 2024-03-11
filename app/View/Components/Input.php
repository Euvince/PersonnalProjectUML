<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Input extends Component
{
    /**
     * Create a new component instance.
     */

    public function __construct(
        public $class1,
        public $class2,
        public $class3,
        /* public $class4 = "", */
        public $id,
        public $label,
        public $type,
        public $name,
        public $placeholder,
        public $readonly,
        public $value
    )
    {

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.input');
    }
}
