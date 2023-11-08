<?php

namespace App\View\Components\Layout\Partial;

use App\Services\Mainmenu;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Navigation extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public Mainmenu $mainmenu
    )
    {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.layout.partial.navigation');
    }
}
