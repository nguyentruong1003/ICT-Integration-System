<?php

namespace App\Http\Livewire\Admin\Unit;

use App\Http\Livewire\Base\BaseLive;
use App\Models\Unit;
use Livewire\Component;

class UnitList extends BaseLive
{
    public $searchName;
    
    public function render()
    {
        $query = Unit::query();

        $data = $query->orderBy('id','asc')->paginate($this->perPage);

        return view('livewire.admin.unit.unit-list', [
            'data' => $data,
        ]);
    }
}
