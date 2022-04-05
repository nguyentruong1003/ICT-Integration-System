<?php

namespace App\Http\Livewire\Admin\Department;

use App\Http\Livewire\Base\BaseLive;
use App\Models\Department;
use App\Models\Employee;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class DepartmentList extends BaseLive
{
    public $searchName;
    public $editId, $name, $code, $description, $leader_id, $created_by, $note, $status;
    
    public function render()
    {
        $query = Department::query();

        if ($this->searchTerm) {
            $query->where('code', 'like', '%' . trim($this->searchTerm) . '%')
                ->orwhere('name', 'like', '%' . trim($this->searchTerm) . '%')
                ->orwhere('description', 'like', '%' . trim($this->searchTerm) . '%')
                ->orwhere('note', 'like', '%' . trim($this->searchTerm) . '%');
        }

        $data = $query->orderBy('name','asc')->paginate($this->perPage);
        $current_user = Auth::user();
        $leaders = Employee::where('position_id', '!=' , '1')
                        ->orwhere('position_id', null)->get();

        return view('livewire.admin.department.department-list', [
            'data' => $data,
            'current_user' => $current_user,
            'leaders' => $leaders,
        ]);
    }

    public function resetInputFields() {
        $this->reset([
            'editId',
            'name',
            'code',
            'description',
            'leader_id',
            'note',
            'created_by',
            'status',
        ]);
        $this->resetValidation();
    }

    public function delete(){
        $department = Department::findOrFail($this->deleteId);
        // $employees = Employee::where('department',$department->id)->get();
        // foreach ($employees as $employee) {
        //     $tmp = User::findorfail($employee->id);
        //     $tmp->department = $department->department_leader;
        //     $tmp->save();
        // }
        $department->delete();
        $this->dispatchBrowserEvent('show-toast', ["type" => "success", "message" => __('notification.common.success.delete')] );
        
    }

    public function create() {
        $this->resetInputFields();
        $this->mode = 'create';
    }

    public function edit($id) {
        $this->resetInputFields();
        $this->editId = $id;
        $this->mode = 'update';
        $item = Department::findorfail($id);
        $this->name = $item->name;
        $this->code = $item->code;
        $this->leader_id = $item->leader_id;
        $this->description = $item->description;
        $this->note = $item->note;
        $this->status = $item->status;
        $this->resetValidation();
    }

    public function standardData(){
        $this->name = trim($this->name);
        $this->code = trim($this->code);
        $this->description = trim($this->description);
        $this->note = trim($this->note);
    }

    public function saveData (){
        $this->standardData();
        $this->validate([
            'code' => 'required|unique:departments,code,'. $this->editId,
            'name' => 'required',
        ]);
        if($this->mode=='create'){
            Department::create([
                'code' => Str::upper($this->code),
                'name' => $this->name,
                'description' => $this->description,
                'leader_id' => $this->leader_id,
                'status' => $this->status ?? 1,
                'note' => $this->note,
                'created_by' => Auth::user()->id,
            ]);
        }
        else {
            Department::findorfail($this->editId)->update([
                'code' => Str::upper($this->code),
                'name' => $this->name,
                'leader_id' => $this->leader_id,
                'description' => $this->description,
                'status' => $this->status,
                'note' => $this->note,
                'updated_by' => Auth::user()->id,
            ]);
        }
        if ($this->leader_id) $this->update_leader();
        $this->resetInputFields();
        if($this->mode=='create'){
            $this->dispatchBrowserEvent('show-toast', ["type" => "success", "message" => 'Thêm mới thành công']);
        }
        else {
            $this->dispatchBrowserEvent('show-toast', ["type" => "success", "message" => 'Chỉnh sửa thành công']);
        }
        $this->emit('closeModalCreateEdit');
    }

    public function update_leader() {
        $emp = Employee::findorfail($this->leader_id);
        $emp->department_id = $this->department_id;
        $emp->position_id = 1;
        $emp->save();
    }
}
