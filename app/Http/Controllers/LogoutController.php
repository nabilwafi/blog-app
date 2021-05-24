<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class LogoutController extends Controller
{
    protected function logout() {

        Auth::logout();
        return Redirect()->route('login')->with('success', 'Successfully Logout from your account');

    }
}
