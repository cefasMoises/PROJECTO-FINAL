<?php
namespace App\Livewire;

use Livewire\Component;

class Select extends Component
{
    public $name;
    public $label;
    public $options = [];

    public function render()
    {
        return view('livewire.select');
    }
}
