<?php

namespace App\Http\Livewire\Admin\User;

use App\Http\Livewire\Base\BaseLive;
use App\Models\User;
use Livewire\Component;

class UserList extends BaseLive
{

    public $searchName;

    public function render() {
        $query=User::query();

        if ($this->searchName) {
            $query->where('name', 'like', '%' . trim(mb_strtolower($this->searchName, 'UTF-8')) . '%');
        }

        $data=$query->orderBy('created_at','desc')->paginate($this->perPage);

        return view('livewire.admin.user.user-list' ,compact('data'));
    }
}
