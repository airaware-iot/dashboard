<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DockLink extends Component
{
	public string $color;

    /**
     * Create a new component instance.
     */
    public function __construct(
		public string $href,
		public string $title,
	) {

		$this->color = (request()->url() == $this->href) ? 'text-complementary' : 'text-white';
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dock-link');
    }
}
