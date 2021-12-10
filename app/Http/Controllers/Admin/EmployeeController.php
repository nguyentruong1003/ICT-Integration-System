<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

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
        // $unit_list = Department::where('id', '!=', '1')->get();
        // $current_user = Auth::user();
        $data = [];
        // $this->check = 1;
        return view('admin.employee.editor', [
            // 'unit_list' => $unit_list,
            // 'current_user' => $current_user, 
            // 'check' => $this->check,
            'data' => $data,
        ]);
    }

    public function store(Request $request) {
        $this->validate($request, [
            'fullname' => 'required|regex:/^([a-zA-Z0-9ÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀẾỂưăạảấầẩẫậắằẳẵặẹẻẽềếểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ\s]+)$/i',
            'code' => 'required|unique:employees|max:6|regex:/^[0-9]+$/',
            'birthday' => 'required|date',
            'sex' => 'required',
            'phone' => 'required',
            'email' => 'required|unique:users',
            'identity_code' => 'required|max:12|regex:/^[0-9]+$/'
        ]);
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

        $user = User::create([
            'name' => $request->fullname,
            'email' => $request->email,
            'password' =>  bcrypt(reFormatDate($request->birthday, 'dmY')),
        ]);

        $role = Role::where('name', 'staff')->first();
        $user->assignRole($role->id);
        $user->save();

        $em->user_map = $user->id;
        $em->save();

        return redirect()->route('admin.employee.index')->with('success', "__('notification.common.success.add')"); 
    }

    public function edit($id) {
        $data = Employee::findorfail($id);
        // $unit_list = Unit::where('id', '!=', '1')->get();
        // $current_user = Auth::user();
        // $this->check = 2;
        // dd($data);
        // return view('admin.employee.edit', [
        //     'data' => $data,
        //     'unit_list' => $unit_list,
        //     'current_user' => $current_user, 
        //     'check' => $this->check,
        // ]);
        return view('admin.employee.editor', [
            'data' => $data,
            'editable' => true,
        ]);
    }

    public function update($id, Request $request) {
        $em = Employee::findorfail($id);
        $this->validate($request, [
            'fullname' => 'required|regex:/^([a-zA-Z0-9ÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀẾỂưăạảấầẩẫậắằẳẵặẹẻẽềếểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ\s]+)$/i',
            'code' => 'required|unique:employees|max:6|regex:/^[0-9]+$/,code'.$em->code,
            'birthday' => 'required|date',
            'sex' => 'required',
            'phone' => 'required',
            'email' => 'required|unique:users,email,'.$em->user_map,
            'identity_code' => 'required|max:12|regex:/^[0-9]+$/'
        ]);
        // dd($request);
        // $em = Employee::findorfail($id);
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
        $em->updated_by = Auth::user()->id;
        $em->ex_province_id = $request->province;
        $em->ex_district_id = $request->district;
        $em->ex_ward_id = $request->ward;
        $em->address = $request->address;

        $user = User::findorfail($em->user_map)->first();
        $user->name = $request->fullname;
        $user->email = $request->email;
        $user->password = bcrypt(reFormatDate($request->birthday, 'dmY'));
        $user->save();
        $em->save();

        return redirect()->route('admin.employee.index')->with('success', "__('notification.common.success.add')"); 
    }

    public function show($id) {
        $data = Employee::findorfail($id);
        $unit_list = Department::where('id', '!=', '1')->get();
        $this->check = 0;
        // dd($data);
        return view('admin.employee.show', [
            'data' => $data,
            'unit_list' => $unit_list,
            'check' => $this->check,
        ]);
    }

    public function updateUser(Request $request) {
        $user = User::updateOrCreate([
            'name' => $request->fullname,
            'email' => $request->email,
            'password' =>  bcrypt(reFormatDate($request->birthday, 'dmY')),
        ]);

        $role = Role::where('name', 'staff')->first();
        $user->assignRole($role->id);
    }
}
