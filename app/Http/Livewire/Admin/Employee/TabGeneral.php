<?php

namespace App\Http\Livewire\Admin\Employee;

use App\Enums\EMasterData;
use App\Models\Department;
use App\Models\Employee;
use App\Models\MasterData;
use Livewire\Component;

class TabGeneral extends Component
{
    public function render()
    {
        return view('livewire.admin.employee.tab-general');
    }

    public $employee;
    public $fullname, $code, $editId, $sex, $birthday, $unit_id, $phone, $email;
    public $departments;
    public $positions;
    public $editable = true;

    // protected $listeners = [
    //     'set-manager-id' => 'setManagerId',
    //     'set-birthday' => 'setBirthday',
    //     'set-working-address-id' => 'setWorkingAddressId'
    // ];

    public function mount($id, $editable)
    {
        $this->departments = Department::all();
        $this->positions = MasterData::query()->where('type', EMasterData::TYPE_POSITION)->get();
        $this->editable = $editable;
        $employee = Employee::query()->findOrNew($id);
        if ($employee) {
            $this->editId = $id;
            $this->name = $employee->name;
            $this->code = $employee->code;
            $this->birthday = $employee->birthday;
            $this->sex = $employee->sex;
            $this->phone = $employee->phone;
            $this->email = $employee->email;
            $this->department_id = $employee->department_id;
            $this->position_id = $employee->position_id;
            $this->working_address_id = $employee->working_address_id;
            $this->manager_id = $employee->manager_id;
        }
    }

    public function save() {
        if ($this->position_id == 1) {
            $item = Department::findorfail($this->department_id);
            if (isset($item->leader)) $this->emit('open-warning-modal');
        } else {
            $this->saveData();
        }
    }

    public function saveData($check = true)
    {
        if ($this->editId) {
            $edit = true;
            $employee = Employee::findorfail($this->editId);
        }
        else {
            $employee = new Employee;
            $edit = false;
        }
        $employee->name = $this->name;
        $employee->code = $this->code;
        $employee->birthday = $this->birthday;
        $employee->sex = $this->sex;
        $employee->phone = $this->phone;
        $employee->email = $this->email;
        $employee->department_id = $this->department_id;
        $employee->working_address_id = $this->working_address_id;
        $employee->manager_id = $this->manager_id;
        if ($this->position_id != 1) {
            $employee->position_id = $this->position_id;
        } else {
            if ($check) {
                Employee::query()->where('department_id', $this->department_id)
                    ->where('position_id', 1)->update([
                        'position_id' => 2,
                    ]);
                $employee->position_id = 1;
            } else {
                $employee->position_id = 2;
            }
        }
        
        $employee->save();
        return redirect()->route('admin.employee.index')->with('success', ($edit) ? __('notification.common.success.update') : __('notification.common.success.add'));
    }

    // public function setManagerId($manager)
    // {
    //     $this->staff->manager_id = array_keys($manager)[0] ?? null;
    // }

    // public function setWorkingAddressId($workingAddress)
    // {
    //     $this->staff->working_address_id = array_keys($workingAddress)[0] ?? null;
    // }

    // public function setBirthday($birthday)
    // {
    //     $this->staff->birthday = date('Y-m-d', strtotime($birthday));
    // }
}

