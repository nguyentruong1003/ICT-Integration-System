<?php

namespace App\Http\Livewire\Admin\Employee;

use App\Models\Employee;
use App\Models\EmployeePrivate;
use Livewire\Component;

class TabPrivate extends Component
{
    
    public $profile_id;

    // public $profile;

    public $emp_name;
    public $emp_id, $marital_status, $other_email, $address, $temporary_address, $ethnic_id, $religion_id, $nationality_id;
    public $identity_card, $identity_card_date, $identity_card_place, $description, $note;

    // public $ethnics;
    // public $religions;
    // public $nations;
    public $editable = true;

    // protected $listeners = [
    //     'set-start-working-date' =>'setStartWorkingDate',
    //     'set-end-working-date' =>'setEndWorkingDate',
    //     'set-identity-card-date' =>'setIdentityCardDate',
    //     'set-passport-date' =>'setPassportDate'
    // ];

    // public function mount($id)
    // {
    //     $this->emp_id = $id;
        // $this->profile = Profile::query()->where('staff_id', $staffId)->firstOrNew();

        // $this->ethnics = StaffMasterData::query()->where('type', StaffMasterData::TYPE_ETHNIC)->get()->pluck('value', 'id')->all();
        // $this->religions = StaffMasterData::query()->where('type', StaffMasterData::TYPE_RELIGION)->get()->pluck('value', 'id')->all();
        // $this->nations = StaffMasterData::query()->where('type', StaffMasterData::TYPE_NATIONALITY)->get()->pluck('value', 'id')->all();
    // }

    // protected function rules()
    // {
    //     return [
    //         'profile.start_working_date' => 'required',
    //         'profile.end_working_date' => 'nullable',
    //         'profile.private_email' => 'required|email',
    //         'profile.marital_status' => 'nullable',
    //         'profile.address' => 'required',
    //         'profile.temporary_address' => 'nullable',
    //         'profile.ethnic_id' => 'required',
    //         'profile.religion_id' => 'required',
    //         'profile.nationality_id' => 'required',
    //         'profile.identity_card' => 'required',
    //         'profile.identity_card_date' => 'required',
    //         'profile.identity_card_place' => 'required',
    //         'profile.passport_number' => 'nullable',
    //         'profile.passport_date' => 'nullable',
    //         'profile.passport_place' => 'nullable',
    //         'profile.insurance_number' => 'nullable',
    //         'profile.tax_number' => 'nullable',
    //         'profile.depenedency_tax_number' => 'nullable',
    //         'profile.note' => 'nullable',
    //     ];
    // }

    // protected function getValidationAttributes()
    // {
    //     return Profile::lang();
    // }

    public function mount($id)
    {
        $profile = EmployeePrivate::query()->where('emp_id', $id)->firstOrNew();
        $this->emp_name = Employee::where('id', $id)->first()->name;
        $this->emp_id = $id;
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
        // $this->validate();
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

    // public function setIdentityCardDate($date)
    // {
    //     $this->profile->identity_card_date = $date;
    // }

    // public function setPassportDate($date)
    // {
    //     $this->profile->passport_date = $date;
    // }
}
