<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangePass extends Controller
{
    public function changePassword() {

        return view('admin.layouts.change_pass');
    }

    public function updatePassword(Request $request) {

        $validateData = $request->validate([
            'current_password' => 'required',
            'password' => 'required|confirmed'
        ]);

        $hashedPassword = Auth::user()->password;
        if(Hash::check($request->current_password, $hashedPassword)) {
            $user = User::find(Auth::id());
            $user->password = Hash::make($request->password);
            $user->save();
            
            Auth::logout();
            return redirect()->route('login')->with('success', 'Password is change sucessfully');
        }else {
            return redirect()->back()->with('error', 'Current password is invalid');
        }

    }

    public function updateProfile() {

        if(Auth::user()) {
            $user = User::find(Auth::user()->id);
            if($user) {
                return view('admin.layouts.change_profile', compact('user'));
            }
        }

    }

    public function changeProfile(Request $request) {
        $user = User::find(Auth::user()->id);

        if($user) {
            $user->name = $request['name'];
            $user->email = $request['email'];

            $user->save();
            return redirect()->back()->with('success','User profile is updated successfully');
        }else {
            return redirect()->back();
        }

    }
}
