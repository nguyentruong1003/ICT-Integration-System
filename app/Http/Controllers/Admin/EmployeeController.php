<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class EmployeeController extends Controller
{
    //
    public $check; // 0 => show, 1 => create, 2 => edit
    public function index()
    {
        return view('admin.employee.index');
    }

    public function create()
    {
        $unit_list = Unit::where('id', '!=', '1')->get();
        $current_user = Auth::user();
        $this->check = 1;
        return view('admin.employee.create', [
            'unit_list' => $unit_list,
            'current_user' => $current_user, 
            'check' => $this->check,
        ]);
    }

    public function store(Request $request) {
        $this->validate($request, [

        ]);
        // dd($request);
        $em = new Employee;
        $em->fullname = $request->fullname;
        $em->code = Str::upper($request->code);
        $em->birthday = $request->birthday;
        $em->sex = $request->sex;
        $em->phone = $request->phone;
        $em->email = $request->email;
        $em->unit_id = ($request->unit) ?? '1';
        $em->identity_code = $request->identity_code;
        $em->description = $request->description;
        $em->note = $request->note;
        $em->created_by = Auth::user()->id;
        $em->ex_province_id = $request->province;
        $em->ex_district_id = $request->district;
        $em->ex_ward_id = $request->ward;
        $em->address = $request->address;
        $em->save();

        return redirect()->route('admin.employee.index')->with('success', "__('notification.common.success.add')"); 
    }
}
