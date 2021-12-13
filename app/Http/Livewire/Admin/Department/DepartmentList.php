<?php

namespace App\Http\Livewire\Admin\Department;

use App\Http\Livewire\Base\BaseLive;
use App\Models\Department;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class DepartmentList extends BaseLive
{
    public $searchName;
    public $department_id, $name, $code, $description, $father_id, $created_by, $note;
    
    public function render()
    {
        $query = Department::query()->where('id', '!=', '1');

        if ($this->searchTerm) {
            $query->where('code', 'like', '%' . trim($this->searchTerm) . '%')
                ->orwhere('name', 'like', '%' . trim($this->searchTerm) . '%')
                ->orwhere('description', 'like', '%' . trim($this->searchTerm) . '%')
                ->orwhere('note', 'like', '%' . trim($this->searchTerm) . '%');
        }

        $data = $query->orderBy('name','asc')->paginate($this->perPage);
        $current_user = Auth::user();
        $department_list = Department::select('name', 'id')->get();
        // dd($current_user);

        return view('livewire.admin.department.department-list', [
            'data' => $data,
            'current_user' => $current_user,
            'department_list' => $department_list,
        ]);
    }

    public function store() {
        $this->validate([
            'code' => 'required|unique:departments',
            'name' => 'required',
        ]);
        $department = new Department();
        $department->code = Str::upper($this->code);
        $department->name = $this->name;
        $department->description = $this->description;
        $department->note = $this->note;
        $department->created_by = Auth::user()->id;
        $department->save();

        $this->resetInputFields();
        $this->emit('close-modal-create');
        $this->dispatchBrowserEvent('show-toast', ["type" => "success", "message" => __('notification.common.success.add')] );
    }

    public function resetInputFields() {
        $this->reset([
            'name',
            'code',
            'description',
            'father_id',
            'note',
            'created_by',
        ]);
    }

    public function delete(){
        $department = Department::findOrFail($this->deleteId);
        // $employees = Employee::where('department',$department->id)->get();
        // foreach ($employees as $employee) {
        //     $tmp = User::findorfail($employee->id);
        //     $tmp->department = $department->department_father;
        //     $tmp->save();
        // }
        $department->delete();
        $this->dispatchBrowserEvent('show-toast', ["type" => "success", "message" => __('notification.common.success.delete')] );
        
    }

    public function edit($id){
        $this->updateMode = true;
        $department = Department::findOrFail($id);
        $this->department_id = $id;
        $this->name = $department->name;
        $this->code = $department->code;
        $this->father_id = $department->father_id;
        $this->description = $department->description;
        $this->note = $department->note;
        $this->resetValidation();
    }

    public function update() {
        $this->validate([
            'code' => 'required|unique:departments,code,'. $this->department_id,
            'name' => 'required',
        ]);
        $department = Department::findorfail($this->department_id);
        $department->code = Str::upper($this->code);
        $department->name = $this->name;
        $department->father_id = ($this->father_id) ?? '1';
        $department->description = $this->description;
        $department->note = $this->note;
        $department->updated_by = Auth::user()->id;
        $department->save();

        $this->resetInputFields();
        $this->emit('close-modal-edit');
        $this->dispatchBrowserEvent('show-toast', ["type" => "success", "message" => __('notification.common.success.update')] );
    }
}
