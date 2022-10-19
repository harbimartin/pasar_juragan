<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SubMenu extends Component {
    public $menu;
    public $ico = ['notif.svg', 'parent.svg', 'content.svg', 'add.svg'];
    public $index;
    public $margin;
    public $on;
    public $level;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($menu, $index, $level, $margin = 3, $on = null) {
        $this->menu = $menu;
        $this->margin = $margin;
        $this->on = $on;
        $this->level = $level;
        $this->index = $index;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render() {
        return view('components.sub-menu');
    }
}
