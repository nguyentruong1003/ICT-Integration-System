<?php

namespace App\Http\Livewire\Base;

use App\Http\Livewire\BasePermission;
use Livewire\Component;
use Livewire\WithPagination;

abstract class BaseLive extends Component
{
	use WithPagination;
    use BasePermission;

	public $deleteId;
    public $reset = false;
    public $searchTerm;

    public $perPage = 25;
    protected  static function paginationView()
    {
        return 'livewire.common.pagination._pagination';
    }
    public function deleteId($id){

        $this->deleteId=$id;
    }
    public function levelClicked(){

    }
    public function resetSearch(){
        $this->reset = true;

    }
    public function updatingSearchTerm() {
        $this->resetPage();
    }
    public function updatingSearchCategory() {
        $this->resetPage();
    }
    public function updatingStore(){
        dd($this->checkEditPermission);
    }
    public function updatingSetDate() {
        $this->resetPage();
    }
    public function updatingPerPage() {
        $this->resetPage();
    }
}
