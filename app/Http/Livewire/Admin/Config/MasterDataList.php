<?php

namespace App\Http\Livewire\Admin\Config;
use App\Models\MasterData;
use App\Http\Livewire\Base\BaseLive;
use Route;

class MasterDataList extends BaseLive
{
    public $searchType;
    public $editId;
    public $key, $type, $value, $order, $url, $note;

    public function render()
    {
        $query = MasterData::query();
        
        if ($this->searchTerm) {
            $query->where('key', 'like', '%' . $this->searchTerm . '%')
                ->orwhere('value', 'like', '%' . $this->searchTerm . '%');
        }
        if($this->searchType) {
            $query->where('type', $this->searchType);
        }

        $data = $query->paginate($this->perPage);

        return view('livewire.admin.config.master-data-list', ['data' => $data,]);
    }

    public function create() {
        $this->resetInputFields();
        $this->mode = 'create';
    }

    public function edit($id) {
        $this->resetInputFields();
        $this->editId = $id;
        $this->mode = 'update';
        $item = MasterData::findorfail($id);
        $this->key = $item->key;
        $this->type = $item->type;
        $this->value = $item->value;
        $this->order = $item->order;
        $this->url = $item->url;
        $this->note = $item->note;
    }

    public function standardData(){
        $this->key = trim($this->key);
        $this->value = trim($this->value);
        $this->order = trim($this->order);
        $this->url = trim($this->url);
        $this->note = trim($this->note);
    }

    public function saveData (){
        $this->standardData();
        $this->validate([
            'key' => 'required',
            'type' => 'required',
            'value' => 'required',
            'order' => 'required|numeric|min:1',
        ]);
        if($this->mode=='create'){
            MasterData::create([
                'key' => $this->key,
                'type' => $this->type,
                'value' => $this->value,
                'order' => $this->order,
                'url' => $this->url,
                'note' => $this->note,
            ]);
        }
        else {
            MasterData::findorfail($this->editId)->update([
                'key' => $this->key,
                'type' => $this->type,
                'value' => $this->value,
                'order' => $this->order,
                'url' => $this->url,
                'note' => $this->note,
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

    public function resetInputFields(){
        $this->reset(['key', 'type', 'value', 'order', 'url', 'note']);
        $this->resetValidation();
    }

    public function delete(){
        MasterData::find($this->deleteId)->delete();
        $this->dispatchBrowserEvent('show-toast', ["type" => "success", "message" => 'Xóa thành công']);
    }

}
