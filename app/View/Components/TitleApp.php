<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TitleApp extends Component
{
    public $title = 'App';
    public $text_action = 'criar novo';
    public $icon = 'bi-house';
    public $action = '/';
    public $type = 'primary';

    public function __construct(
        string $title = 'App',
        string $textAction = 'criar novo',
        string $icon = 'bi-house',
        string $action = '/',
        string $type = 'primary'
    ) {
        $this->title = $title;
        $this->text_action = $textAction;
        $this->icon = $icon;
        $this->action = $action;
        $this->type = $type;
    }


    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.title-app');
    }
}
