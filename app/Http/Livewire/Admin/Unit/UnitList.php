<?php

namespace App\Http\Livewire\Admin\Unit;

use App\Http\Livewire\Base\BaseLive;
use App\Models\Department;
use App\Models\Employee;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Str;

class UnitList extends BaseLive
{
    public $searchName;
    public $unit_id, $name, $code, $description, $father_id, $created_by, $note;
    
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
        $unit_list = Department::select('name', 'id')->get();
        // dd($current_user);

        return view('livewire.admin.unit.unit-list', [
            'data' => $data,
            'current_user' => $current_user,
            'unit_list' => $unit_list,
        ]);
    }

    public function store() {
        $this->validate([
            'code' => 'required|unique:departments',
            'name' => 'required',
        ]);
        $unit = new Department();
        $unit->code = Str::upper($this->code);
        $unit->name = $this->name;
        $unit->description = $this->description;
        $unit->note = $this->note;
        $unit->created_by = Auth::user()->id;
        $unit->save();

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
        $unit = Department::findOrFail($this->deleteId);
        // $employees = Employee::where('unit',$unit->id)->get();
        // foreach ($employees as $employee) {
        //     $tmp = User::findorfail($employee->id);
        //     $tmp->unit = $unit->unit_father;
        //     $tmp->save();
        // }
        $unit->delete();
        $this->dispatchBrowserEvent('show-toast', ["type" => "success", "message" => __('notification.common.success.delete')] );
        
    }

    public function edit($id){
        $this->updateMode = true;
        $unit = Department::findOrFail($id);
        $this->unit_id = $id;
        $this->name = $unit->name;
        $this->code = $unit->code;
        $this->father_id = $unit->father_id;
        $this->description = $unit->description;
        $this->note = $unit->note;
        $this->resetValidation();
    }

    public function update() {
        $this->validate([
            'code' => 'required|unique:departments,code,'. $this->unit_id,
            'name' => 'required',
        ]);
        $unit = Department::findorfail($this->unit_id);
        $unit->code = Str::upper($this->code);
        $unit->name = $this->name;
        $unit->father_id = ($this->father_id) ?? '1';
        $unit->description = $this->description;
        $unit->note = $this->note;
        $unit->updated_by = Auth::user()->id;
        $unit->save();

        $this->resetInputFields();
        $this->emit('close-modal-edit');
        $this->dispatchBrowserEvent('show-toast', ["type" => "success", "message" => __('notification.common.success.update')] );
    }
}
