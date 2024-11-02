<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class adminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function login(Request $request)
    {

        return view('adminLogin');
    }
    public function logined(Request $request)
    {

        $credentials = $request->validate([
            'email' => ['required'],
            'password' => ['required'],
        ]);

       if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            //Auth::login($user);
            //return redirect()->route('profile');
            return redirect()->intended('list');
        }
        return back();
    }
    public function list()
    {

        $users = Users::get()->sortByDesc("id");

        return view('adminList', compact('users'));
    }
}
