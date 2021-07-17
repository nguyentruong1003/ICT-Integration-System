<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\unit;
use Hash;
use DB;

class UnitsController extends Controller
{
    
    public function index()
    {
        $units = DB::table('units')
                ->select('*')
                ->paginate(100);

        $current_user = Auth::user();
        if ($current_user->admin) {
        return view('units.index', compact('units', 'current_user'));
        }
        return redirect('/home');
    }

    

    public function show($id)
    {
        if(Auth::user()->admin) {
            $unit = Unit::find($id);
            $current_user = Auth::user();
            return view('units.view', compact('unit', 'current_user'));
        }
        else {
            return redirect('/home');
        }
    }

    public function create()
    {
        if(Auth::user()->admin) {
            $current_user = Auth::user();
            $units = DB::table('units')->select('unit_name')->get();
            $unit_name = array();
            foreach ($units as $unit) {
                $unit_name[] = $unit->unit_name;
            }
            return view('units.create', compact('current_user', 'unit_name'));
        }
        else {
            return redirect('/home');
        }
    }
    public function store(Request $request)
    {
        if(Auth::user()->admin) {

            $validatedData = $request->validate([
                'unit_name' => 'required|unique:units|max:100|min:3',
                'unit_id' => 'required|unique:units|min:2|max:50',
            ]);
            
            $unit = new Unit;
            $unit->unit_name = $request->unit_name;
            $unit->unit_id = $request->unit_id;
            $unit->unit_father = $request->unit_father;
            $unit->description = $request->description;
            $unit->created_by = $request->created_by;
           
            $unit->save();

            return redirect('/units')->with('msg_success', 'Unit Created Successfully');
            
        }
        else {
            return redirect('/home');
        }
    }

    public function edit($id)
    {
        if(Auth::user()->admin) {
            $unit = Unit::find($id);
            $current_user = Auth::user();
            $units = DB::table('units')->select('unit_name')->get();
            $unit_name = array();
            foreach ($units as $value) {
                $unit_name[] = $value->unit_name;
            }
            return view('units.edit', compact('unit', 'current_user', 'unit_name'));

        }
        else {
            return redirect('/home');
        }
    }

    public function update(Request $request, $id)
    {
        if(Auth::user()->admin) {

            $validatedData = $request->validate([
                'unit_name' => 'required|max:100|min:3',
                'unit_id' => 'required|min:2|max:50',
                
            ]);
            $unit = Unit::find($id);
            $unit->unit_name = $request->unit_name;
            $unit->unit_id = $request->unit_id; 
            
            $unit->unit_father = $request->unit_father;
            $unit->description = $request->description;
            $unit->updated_by = $request->updated_by;
           
            $unit->save();

            return redirect('/units')->with('msg_success', 'Unit Updated Successfully');
        }
        else {
            return redirect('/home');
        }
    }

    public function destroy($id)
    {
        if(Auth::user()->admin) {
            $unit = Unit::find($id);
            
            $id_users = DB::table('users')->select('id')->where('unit',$unit->unit_name)->get();
            foreach ($id_users as $id_user) {
                $id = $id_user->id;
                $user = User::find($id);
                $user->unit = $unit->unit_father;

                $user->save();
            }

            $id_units = DB::table('units')->select('id')->where('unit_father',$unit->unit_name)->get();
            foreach ($id_units as $id_unit) {
                $id = $id_unit->id;
                $unit_tmp = Unit::find($id);
                $unit_tmp->unit_father = $unit->unit_father;

                $unit_tmp->save();
            }

            $unit->delete();
            return redirect('/units')->with('msg_success', 'Unit Deleted Successfully');
        }
        else {
            return redirect('/home');
        }
    }
}
