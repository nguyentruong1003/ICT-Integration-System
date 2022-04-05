<?php

namespace App\Http\Livewire\Admin\System\User;

use App\Http\Livewire\Base\BaseLive;
use App\Models\User;
use Livewire\Component;

class UserList extends BaseLive
{

    public $searchName;
    public $editId;
    public $name;
    public $email;
    public $password;
    public $confirm_password;

    public function render() {
        $query=User::query();
        if ($this->searchName) {
            $query->where('name', 'like', '%' . trim(mb_strtolower($this->searchName, 'UTF-8')) . '%');
        }

        $data=$query->orderBy('id','asc')->paginate($this->perPage);

        return view('livewire.admin.system.user.user-list' ,compact('data'));
    }

    public function resetInputFields() {
        $this->reset([
            'editId',
            'name',
            'email',
            'password',
            'confirm_password',
        ]);
        $this->resetValidation();
    }

    public function create() {
        $this->resetInputFields();
        $this->mode = 'create';
    }

    public function saveData() {
        $this->standardData();
        $this->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email,'. $this->editId,
            'password' => 'required',
            'confirm_password'=> 'required_with:password|same:password',
        ]);
        if($this->mode=='create'){
            User::create([
                'name' => $this->name,
                'email' => $this->email,
                'password' => bcrypt($this->password),
            ]);
        }
        else {
            User::findorfail($this->editId)->update([
                'name' => $this->name,
                'email' => $this->email,
                'password' => bcrypt($this->password),
            ]);
        }

        $this->resetInputFields();
        if($this->mode=='create'){
            $this->dispatchBrowserEvent('show-toast', ["type" => "success", "message" => 'Thêm mới thành công']);
        }
        else {
            $this->dispatchBrowserEvent('show-toast', ["type" => "success", "message" => 'Chỉnh sửa thành công']);
        }
        $this->emit('closeModalCreateEdit');
    }

    public function edit($id){
        $this->mode = 'update';
        $user = User::findOrFail($id);
        $this->editId = $id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->resetValidation();
    }

    public function delete(){
        User::findOrFail($this->deleteId)->delete();
        $this->dispatchBrowserEvent('show-toast', ["type" => "success", "message" => __('notification.common.success.delete')] );
    }

    public function standardData(){
        $this->name = trim($this->name);
        $this->email = trim($this->email);
        $this->password = trim($this->password);
    }

}
