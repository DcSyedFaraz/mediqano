<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MenuItem extends Component
{
    public $route;
    public $icon;
    public $active;
    public $hasSub;
    public $action;
    public $class;

    /**
     * Create a new component instance.
     *
     * @param string|null $route
     * @param string|null $icon
     * @param bool $active
     * @param bool $hasSub
     * @param string|null $action
     * @param string|null $class
     * @return void
     */
    public function __construct($route = null, $icon = null, $active = false, $hasSub = false, $action = null, $class = null)
    {
        $this->route = $route;
        $this->icon = $icon;
        $this->active = $active;
        $this->hasSub = $hasSub;
        $this->action = $action;
        $this->class = $class;
    }

    /**
     * Determine if the menu item should have 'active' or 'open' classes.
     *
     * @return string
     */
    public function getClasses()
    {
        $classes = 'menu-item';

        if ($this->active) {
            $classes .= ' active';
        }

        if ($this->hasSub && $this->active) {
            $classes .= ' open';
        }

        if ($this->class) {
            $classes .= ' ' . $this->class;
        }

        return $classes;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.menu-item');
    }
}
