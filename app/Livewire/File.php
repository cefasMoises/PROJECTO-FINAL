<?php
namespace App\Livewire;

use Livewire\Component;

class File extends Component
{
    public $name;
    public $label;

    public function render()
    {
        return view('livewire.file');
    }
}
