<?php

namespace App\Http\Livewire\Admin\Config;
use App\Models\MasterData;
use App\Http\Livewire\Base\BaseLive;

class MasterDataList extends BaseLive
{
    public $searchType;

    public function render()
    {
        $query = MasterData::query();
        
        if ($this->searchTerm) {
            $query->where('key', 'like', '%' . $this->searchTerm . '%')
                ->orwhere('value', 'like', '%' . $this->searchTerm . '%');
        }
        if($this->searchType) {
            $query->where('type', $this->searchType);
        }

        $data = $query->paginate($this->perPage);

        return view('livewire.admin.config.master-data-list', ['data' => $data,]);
    }

}
