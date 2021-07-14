<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Hash;
use DB;

class ProfileController extends Controller
{
    public function show()
    {
        if(Auth::user()->admin == 0) { 
            $user_id = Auth::user()->id;
            $user = User::find($user_id);
            return view('profile.view', compact('user'));
        }
        else {
            return redirect('/admin-panel');
        }
    }

    
    public function edit()
    {       
        if(Auth::user()->admin == 1) { 
            $current_user = Auth::user(); 
            $id = Auth::user()->id;
            $user = User::find($id);
            $units = DB::table('units')->select('unit_name')->get();
            $unit_name = array();
            
            foreach ($units as $unit) {
                $unit_name[] = $unit->unit_name;
            }
            
            return view('users.edit', compact('user', 'current_user', 'unit_name'));
        }
        else {
            
            return redirect('/home');
        }
        
    }

    
    public function update(Request $request)
    {

        $validatedData = $request->validate([
            'name' => 'required:max:40',
            'email' => 'required|max:190',
            'password' => 'nullable|min:8|confirmed',
        ]);

        if(Auth::user()->admin == 0) { 
            $id = Auth::user()->id;
            $user = User::find($id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->birth_date = $request->birth_date;
            $user->gender = $request->gender; 
            $user->country = $request->country;
            if($user->password) {
                $user->password = Hash::make($request->password);
            }
            if($request->hasFile('image')) {
                $user->image = $request->image->store('profile_pics', 'public');
            }
            $user->save();

            return redirect('/home')->with('msg_success', 'Your Profile is Updated');
        }
        else {
            return redirect('/admin-panel');
        }
    }

    
}
