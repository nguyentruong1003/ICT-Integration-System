<?php

namespace App\Http\Livewire\Admin\Config;
use Livewire\Component;
use App\Models\MasterData;
use App\Http\Livewire\Base\BaseLive;
use Laravel\Passport\HasApiTokens;

class MasterDataList extends BaseLive
{
    public $selectedtypes = [];
    public $status = false ;
    public $vkey ;
    public $vvalue  ;
    public $vvalueen  ;
    public $ordernumber ;
    public $parentid  ;
    public $type  ;
    public $ID ;
    public $search ;
    public $typeFilter;

    public function removeall()
    {
        $this->status=true;
    }

    public function mount()
    {
        $this->checkDestroyPermission = checkRoutePermission('destroy');
        $this->checkCreatePermission = checkRoutePermission('create');
        $this->checkEditPermission = checkRoutePermission('edit');
    }

    public function render()
    {
        $data = MasterData::query();
        if($this->search) {
            $searchTerm = $this->search;
            $data->where(function($where) use ($searchTerm) {
                $where->whereRaw('lower(v_value) like ? ', ['%' . trim(mb_strtolower($searchTerm, 'UTF-8')) . '%'])
                    ->orWhereRaw('lower(v_value_en) like ? ', ['%' . trim(mb_strtolower($searchTerm, 'UTF-8')) . '%']);
                });
        }
        if($this->typeFilter) {
            $data = $data->where('type', $this->typeFilter);
        }
        $data = $data->orderBy('id','DESC')->paginate($this->perPage);
        $dataType = MasterData::get()->unique('type');
        return view('livewire.admin.config.master-data-list', ['category' => $data, 'dataType' => $dataType]);
    }
    public function resetform()
    {
        $this->vkey = null;
        $this->vvalue = null;
        $this->vvalueen = null;
        $this->ordernumber = null;
        $this->type = null;
        $this->parentid = null;
    }

    public function store()
    {

     $this->validate([
            'vkey'=>'required',
            'type'=>'required',

           ],[],[
            'vkey'=>__('master/masterManager.menu_name.master_title_table.vkey'),
            'type'=>__('master/masterManager.menu_name.master_title_table.type'),
    ]);
        $master = new MasterData;
        $master->v_key = $this->vkey;
        $master->v_value = $this->vvalue;
        $master->v_value_en = $this->vvalueen;
        $master->order_number = $this->ordernumber;
        $master->type = $this->type;
        $master->parent_id = $this->parentid;
        $master->save();
        $this->emit('close');
        $this->dispatchBrowserEvent('show-toast', ["type" => "success", "message" => __('notification.common.success.add')] );
    }

    public function delete()
    {
       MasterData::findOrFail($this->deleteId)->delete();
       $this->dispatchBrowserEvent('show-toast', ["type" => "success", "message" => __('notification.common.success.delete')] );
    }

    public function edit($id)
    {

        $master = MasterData::findOrFail($id);
        $this->ID = $master->id;
        $this->vkey = $master->v_key;
        $this->vvalue = $master->v_value;
        $this->type = $master->type;
        $this->vvalueen= $master->v_value_en ;
        $this->parentid = $master -> parent_id;
        $this->resetValidation();

    }

    public function update()
    {
        $this->validate([
            'vkey'=>'required',
            'type'=>'required',],[],[
            'vkey'=>'phím chính',
            'type'=>'thể loại',
         ]);
       $id = $this->ID;
       $master=MasterData::findOrFail($id);
       $master->v_key = $this->vkey;
       $master->v_value = $this->vvalue;
       $master->v_value_en = $this->vvalueen;
       $master->order_number = $this->ordernumber;
       $master->type = $this->type;
       $master->parent_id = $this->parentid;
       $master->save();
       $this->emit('close');
       $this->dispatchBrowserEvent('show-toast', ["type" => "success", "message" => __('notification.common.success.update')] );
    }


}
