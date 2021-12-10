<?php

namespace App\Http\Livewire\Admin\Employee;

use App\Enums\EMasterData;
use App\Http\Livewire\Base\BaseLive;
use App\Models\Department;
use App\Models\Employee;
use App\Models\MasterData;

class EmployeeList extends BaseLive
{
    public $searchName;
    public function render()
    {
        $query = Employee::query();

        $data = $query->orderBy('id','asc')->paginate($this->perPage);
        $departments = Department::all();
        $positions = MasterData::query()->where('type', EMasterData::TYPE_POSITION)->get();

        return view('livewire.admin.employee.employee-list', [
            'data' => $data,
            'departments' => $departments,
            'positions' => $positions,
        ]);
    }

    public function delete(){
        Employee::findorfail($this->deleteId)->delete();
        $this->dispatchBrowserEvent('show-toast', ["type" => "success", "message" => __('notification.common.success.delete')] );
        
    }
}
