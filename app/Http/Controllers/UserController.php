<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\users_company;
use App\Models\users_skill;
use App\Models\users_history;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $userdata = User::where('email', $request->email)->first();
        $user = User::find($userdata[ 'id' ]);
        $token = "";
        if (password_verify($request->password, $user['password'])) {
            $token = $user->createToken('my-app-token')->plainTextToken;
            $response = [
                'user' => $user,
                'token' => $token
            ];

            return response($response, 201);
        }

        return response("error", 401);
    }
    public function logout(Request $request)
    {
        //auth()->guard('web')->logout();
        try{
            Auth::guard('sanctum')->user()->tokens()->delete();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return response("Unauthenticated", 201);
        }catch(Exception $e){
            return response("Unauthenticated Error", 401);
        }


    }
    public function top(Request $request)
    {
        $code = $request->code;
        $userdata = User::where('code', $code)
        ->where("status",1)
        ->first();
        $user_companies = users_company::where("user_id",1)->get();
        $users_skill = users_skill::where("user_id",1)->get();
        $users_history = users_history::where("user_id",1)->get();
        return response(['user'=>$userdata,'company'=>$user_companies,'skill'=>$users_skill,'history'=>$users_history], 201);

    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
