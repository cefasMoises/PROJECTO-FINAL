<?php
namespace App\Livewire;

use Livewire\Component;

class Input extends Component
{
    public $label;
    public $name;
    public $options = [];

    public function render()
    {
        return view('livewire.input');
    }
}
