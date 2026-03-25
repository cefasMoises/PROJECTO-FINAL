<?php

namespace App\Livewire;

use Livewire\Component;

class Datetime extends Component
{


    public $name;
    public $date='10-12-2004';
    public $label='date';

    public function render()
    {
        return view('livewire.datetime');
    }
}
