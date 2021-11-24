<?php

namespace App\Http\Livewire\Admin\System\User;

use App\Http\Livewire\Base\BaseLive;
use App\Models\User;
use Livewire\Component;

class UserList extends BaseLive
{

    public $searchName;
    public $name;
    public $email;
    public $password;
    public $confirm_password;
    public $checkEdit = true;

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
            'name',
            'email',
            'password',
            'confirm_password',
        ]);
    }

    public function store() {
        $this->validate([
            
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required',
            'confirm_password'=> 'required_with:password|same:password',
        ],[],[

        ]);

        // dd($this);
        $user = new User;
        $user->name = $this->name;
        $user->email = $this->email;
        $user->password = bcrypt($this->password);
        $user->save();

        $this->resetInputFields();
        $this->emit('close-modal-create');
        $this->dispatchBrowserEvent('show-toast', ["type" => "success", "message" => __('notification.common.success.add')] );
    }

    public function edit($id){
        $this->updateMode = true;
        $user = User::findOrFail($id);
        $this->name = $user->name;
        $this->email = $user->email;
        // $this->password = $user->password;
        // $this->confirm_password = '';
        $this->resetValidation();
    }

    public function update(){

        $this->validate([
            
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required',
            'confirm_password'=> 'required_with:password|same:password',
        ],[],[

        ]);

        $user = User::findorfail($this->id);
        $user->name = $this->name;
        $user->email = $this->email;
        $user->password = bcrypt($this->password);
        $user->save();

        $this->resetInputFields();
        $this->emit('close-modal-edit');
        $this->updateMode = false;

        $this->dispatchBrowserEvent('show-toast', ["type" => "success", "message" => __('notification.common.success.update')] );
    }

    public function delete(){
        User::findOrFail($this->deleteId)->delete();
        $this->dispatchBrowserEvent('show-toast', ["type" => "success", "message" => __('notification.common.success.delete')] );
        
    }

}
