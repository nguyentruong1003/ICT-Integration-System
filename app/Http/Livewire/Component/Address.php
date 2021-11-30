<?php

namespace App\Http\Livewire\Component;

use App\Models\Order;
use Livewire\Component;
use App\Models\District;
use App\Models\MasterData;
use App\Models\Province;
use App\Models\Supplier;
use App\Models\Customer;
use App\Models\Ward;
class Address extends Component
{
	public $ward_id, $district_id,$province_id, $address, $status=false;
    protected $listeners=['fillAddress','resetAddress'];
	public $order_id;
    public function render()
    {
        if(isset($_GET['show'])){
            $this->status=true;
        }
    	$ward=[];
        $district=[];
        if(isset($_GET['id'])) {
            $this->order_id = $_GET['id'];
        }
        
        $province = Province::orderBy('name')->pluck('name','province_code');
    	if($this->province_id){
            $district=District::where('province_code',$this->province_id)->orderBy('name')->pluck('name','district_code');
            if($this->district_id){
                $ward=Ward::where('district_code',$this->district_id)->orderBy('name')->pluck('name','ward_code');
            }
            $this->emit('setAddress', $this->province_id, $this->district_id, $this->ward_id, $this->address);
            // $this->dispatchBrowserEvent('setSelect2');
        }
        return view('livewire.component.address', ['province' => $province, 'district' => $district ,'ward' => $ward]);
    }
    public function fillAddress($province_id,$district_id,$ward_id,$address){
        $this->province_id = $province_id;
        $this->ward_id = $ward_id;
        $this->district_id = $district_id;
        $this->address = $address;
    }
    public function resetAddress(){
        $this->province_id = '';
        $this->ward_id = '';
        $this->district_id = '';
        $this->address='';
    }
}
