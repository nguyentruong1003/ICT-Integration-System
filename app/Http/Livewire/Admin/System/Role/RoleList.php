<?php

namespace App\Http\Livewire\Admin\System\Role;

use App\Http\Livewire\Base\BaseLive;
use App\Models\Role;
use Livewire\Component;

class RoleList extends BaseLive
{
    public $searchName;
    public $checkEdit = true;

    public function render() {
        $query=Role::query();

        if ($this->searchName) {
            $query->where('name', 'like', '%' . trim(mb_strtolower($this->searchName, 'UTF-8')) . '%');
        }

        $data=$query->orderBy('id','asc')->paginate($this->perPage);

        return view('livewire.admin.system.role.role-list' ,compact('data'));
    }

    // public function delete(){
    //     Role::findOrFail($this->deleteId)->delete();
    //     $this->dispatchBrowserEvent('show-toast', ["type" => "success", "message" => __('notification.common.success.delete')] );
        
    // }
}
