<?php
namespace App\Http\Livewire;
use Illuminate\Support\Facades\Log;

trait BasePermission
{
    public $checkDeletePermission;
    public $checkCreatePermission;
    public $checkEditPermission;
    public function mountBasePermission()
    {
        $this->checkDeletePermission = checkRoutePermission('delete');
        $this->checkCreatePermission = checkRoutePermission('create');
        $this->checkEditPermission = checkRoutePermission('edit');
    }
    public function create(){
        if(!$this->checkCreatePermission){
            abort(403, 'Unauthorized action.');
        }      
    }
    public function edit($id){
        if(!$this->checkEditPermission){
            abort(403, 'Unauthorized action.');
        }    
    }
    public function delete(){

        if(!$this->checkDeletePermission){
            abort(403, 'Unauthorized action.');
        }
    }
    public function store(){
        if(!$this->checkCreatePermission){
            abort(403, 'Unauthorized action.');
        }  
    }
}