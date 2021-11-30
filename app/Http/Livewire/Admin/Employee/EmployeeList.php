<?php

namespace App\Http\Livewire\Admin\Employee;

use App\Http\Livewire\Base\BaseLive;
use App\Models\Employee;
use Livewire\Component;

class EmployeeList extends BaseLive
{
    public $searchName;
    public function render()
    {
        $query = Employee::query();

        $data = $query->orderBy('id','asc')->paginate($this->perPage);

        return view('livewire.admin.employee.employee-list', [
            'data' => $data,
        ]);
    }

    public function delete(){
        Employee::findorfail($this->deleteId)->delete();
        $this->dispatchBrowserEvent('show-toast', ["type" => "success", "message" => __('notification.common.success.delete')] );
        
    }
}
