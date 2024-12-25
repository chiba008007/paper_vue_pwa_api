<?php

namespace App\Http\Controllers;

use App\Models\User;
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

            $userdata = User::where('email', $request->email)->first();
            $user = User::find($userdata[ 'id' ]);
            if($user[ 'code' ] === 'adminis'){
                return redirect()->intended('list');
            }else{
                echo "login error";
                exit();
            }
        }
        return back();
    }
    public function list()
    {

        $users = User::get()->sortByDesc("id");

        return view('adminList', compact('users'));
    }
    public function listed(Request $request)
    {

        foreach( $request->input('status') as $key=>$value){
            $user = User::find($key);
            $user->status = $value;
            $user->save();
        }
        $users = User::get()->sortByDesc("id");
        return view('adminList', compact('users'));
    }
}
