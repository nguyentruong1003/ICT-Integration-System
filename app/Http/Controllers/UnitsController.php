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
                ->paginate(20);

        // $units = $units->get();

        return view('units.index', compact('units'));
    }

    

    public function show($id)
    {
        if(Auth::user()->admin) {
            $unit = Unit::find($id);
            return view('units.view', compact('unit'));
        }
        else {
            return redirect('/home');
        }
    }

    public function create()
    {
        if(Auth::user()->admin) {
            $current_user = Auth::user();
            return view('units.create', compact('current_user'));
        }
        else {
            return redirect('/home');
        }
    }
    public function store(Request $request)
    {
        if(Auth::user()->admin) {

            $validatedData = $request->validate([
                'unit_name' => 'required|max:100|min:3',
                'unit_id' => 'required|min:2|max:50',
                // 'password' => 'required|min:8',
                // 'unit' => 'required|max:40',
                // 'address' => 'required|max:255',
                // 'create_by' => 'required|min:3|max:255'
            ]);
            
            $unit = new Unit;
            $unit->unit_name = $request->unit_name;
            $unit->unit_id = $request->unit_id;
            // $unit->birth_date = $request->birth_date;
            // $unit->gender = $request->gender; 
            
            $unit->unit_father = $request->unit_father;
            $unit->description = $request->description;
            // $unit->address = $request->address;
            // $unit->password = Hash::make($request->password);
            $unit->created_by = $request->created_by;
           
            $unit->save();

            return redirect('/admin-panel')->with('msg_success', 'Unit Created Successfully');
            
        }
        else {
            return redirect('/home');
        }
    }

    public function edit($id)
    {
        if(Auth::user()->admin) {
            $unit = Unit::findOrFail($id);
            $current_user = Auth::user();
            return view('units.edit', compact('unit', 'current_user'));

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

            return redirect('/admin-panel')->with('msg_success', 'Unit Updated Successfully');
        }
        else {
            return redirect('/home');
        }
    }

    public function destroy($id)
    {
        if(Auth::user()->admin) {
            $unit = Unit::find($id);
            $unit->delete();
            return redirect('/admin-panel')->with('msg_success', 'Unit Deleted Successfully');
        }
        else {
            return redirect('/home');
        }
    }
}
