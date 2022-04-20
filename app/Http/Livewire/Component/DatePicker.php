<?php

namespace App\Http\Livewire\Component;

use Livewire\Component;

class DatePicker extends Component
{
    public $placeholder = 'dd/mm/yyyy';
    public $format = 'dd/mm/yyyy';
    public $value;
    public $name;
    public $min;
    public $max;
    public $disabled = false;
    public $container = 'body';

    public function render()
    {
        return view('livewire.component.date-picker');
    }
}
