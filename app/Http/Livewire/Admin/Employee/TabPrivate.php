<?php

namespace App\Http\Livewire\Admin\Employee;

use App\Enums\EMasterData;
use App\Models\Employee;
use App\Models\EmployeePrivate;
use App\Models\MasterData;
use App\Models\Province;
use Livewire\Component;

class TabPrivate extends Component
{
    
    public $profile_id;

    // public $profile;

    public $emp_name;
    public $emp_id, $marital_status, $other_email, $address, $temporary_address, $ethnic_id, $religion_id, $nationality_id;
    public $identity_card, $identity_card_date, $identity_card_place, $description, $note;

    public $ethnics;
    public $religions;
    public $nationalities;
    public $provinces;
    public $editable = true;

    protected $listeners = [
        'set-identity_card_date' => 'setIdentityCardDate'
    ];

    public function mount($id, $editable)
    {
        $profile = EmployeePrivate::query()->where('emp_id', $id)->firstOrNew();
        $this->ethnics = MasterData::query()->where('type', EMasterData::TYPE_ETHNIC)->get();
        $this->religions = MasterData::query()->where('type', EMasterData::TYPE_RELIGION)->get();
        $this->nationalities = MasterData::query()->where('type', EMasterData::TYPE_NATIONALITY)->get();
        $this->provinces = Province::query()->orderBy('short_name', 'asc')->get()->pluck('short_name');
        $this->emp_name = Employee::where('id', $id)->first()->name;
        $this->emp_id = $id;
        $this->editable = $editable;
        if ($profile) {
            $this->profile_id = $profile->id;
            $this->other_email = $profile->other_email;
            $this->marital_status = $profile->marital_status;
            $this->address = $profile->address;
            $this->temporary_address = $profile->temporary_address;
            $this->ethnic_id = $profile->ethnic_id;
            $this->religion_id = $profile->religion_id;
            $this->nationality_id = $profile->nationality_id;
            $this->identity_card = $profile->identity_card;
            $this->identity_card_date = $profile->identity_card_date;
            $this->identity_card_place = $profile->identity_card_place;
            $this->description = $profile->description;
            $this->note = $profile->note;
        }
    }

    public function save()
    {
        if ($this->identity_card) {
            $this->validate([
                'identity_card_date' => 'required',
                'identity_card_place' => 'required',
            ],[
                'identity_card_date.required' => 'Trường bắt buộc nhập với CMND/CCCD',
                'identity_card_place.required' => 'Trường bắt buộc nhập với CMND/CCCD',
            ]);
        }
        if ($this->profile_id) {
            $profile = EmployeePrivate::findorfail($this->profile_id);
        }
        else {
            $profile = new EmployeePrivate;
            $profile->emp_id = $this->emp_id;
        }
        $profile->other_email = $this->other_email;
        $profile->marital_status = $this->marital_status;
        $profile->address = $this->address;
        $profile->temporary_address = $this->temporary_address;
        $profile->ethnic_id = $this->ethnic_id;
        $profile->religion_id = $this->religion_id;
        $profile->nationality_id = $this->nationality_id;
        $profile->identity_card = $this->identity_card;
        $profile->identity_card_date = $this->identity_card_date;
        $profile->identity_card_place = $this->identity_card_place;
        $profile->description = $this->description;
        $profile->note = $this->note;
        $profile->save();
        $this->redirect(route('admin.employee.index'));
    }

    public function render()
    {
        return view('livewire.admin.employee.tab-private');
    }

    // public function save()
    // {
    //     $this->validate();

    //     $this->profile->emp_id = $this->emp_id;
    //     $this->profile->save();

    //     $this->redirect(route('admin.employee.index'));
    // }

    // public function setStartWorkingDate($date)
    // {
    //     $this->profile->start_working_date = $date;
    // }

    // public function setEndWorkingDate($date)
    // {
    //     $this->profile->end_working_date = $date;
    // }

    public function setIdentityCardDate($date)
    {
        $this->identity_card_date = $date;
    }

    // public function setPassportDate($date)
    // {
    //     $this->profile->passport_date = $date;
    // }
}
