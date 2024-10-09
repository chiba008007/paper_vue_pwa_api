<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Readed;
use App\Models\users_company;
use App\Models\users_skill;
use App\Models\users_history;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
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
    public function getEditUser(Request $request){

        $user = Auth::user();

        $user_companies = users_company::where("user_id",$user->id)->where("status",1)->get();
        $users_skill = users_skill::where("user_id",$user->id)->where("status",1)->get();
        $users_history = users_history::where("user_id",$user->id)->where("status",1)->get();

        return response(['user'=>$user,'company'=>$user_companies,'skill'=>$users_skill,'history'=>$users_history], 201);
    }
    public function editUser(Request $request){
        DB::beginTransaction();
        try{
            $user = Auth::user();
            $id = $user->id;
            $update = User::find($id);
            // $update->name = $request->name;
            // $update->email = $request->email;
            $update->tel = $request->tel;
            $update->post = $request->post;
            $update->pref = $request->pref;
            $update->address = $request->address;
            $update->display_name = $request->display_name;
            $update->syozoku = $request->syozoku;
            $update->kana = $request->kana;
            if($request->myimage_path) $update->myimage_path = $request->myimage_path;
            $update->company_name = $request->company_name;
            if($request->company_image_path) $update->company_image_path = $request->company_image_path;
            $update->company_url = $request->company_url;
            $update->profile = $request->profile;
            $update->save();
            $companies = $request->companies;
            $skills = $request->skills;
            $histories = $request->histories;

            // ステータスを0にして新しいデータを登録する
            users_company::where("user_id",$user->id)->where("status",1)->update(['status' => 0]);
            users_skill::where("user_id",$user->id)->where("status",1)->update(['status' => 0]);
            users_history::where("user_id",$user->id)->where("status",1)->update(['status' => 0]);

            $insert = [];
            $i=0;
            foreach($companies as $value){
                $insert[$i]['user_id'] = $user->id;
                $insert[$i]['address'] = $value['address'];
                $insert[$i]['map_url'] = $value['map_url'];
                $insert[$i]['order'] = $i+1;
                $insert[$i]['created_at'] = now();
                $i++;
            }
            users_company::insert($insert);
            $insert = [];
            $i=0;
            foreach($skills as $value){
                $insert[$i]['user_id'] = $user->id;
                $insert[$i]['note'] = $value['note'];
                $insert[$i]['order'] = $i+1;
                $insert[$i]['created_at'] = now();
                $i++;
            }
            users_skill::insert($insert);
            $insert = [];
            $i=0;
            foreach($histories as $value){
                $insert[$i]['user_id'] = $user->id;
                $insert[$i]['title'] = $value['title'];
                $insert[$i]['note'] = $value['note'];
                $insert[$i]['order'] = $i+1;
                $insert[$i]['created_at'] = now();
                $i++;
            }
            users_history::insert($insert);



            DB::commit();
            return response("success", 201);

        }catch(Exception $e){
            DB::rollback();
            return response($e, 400);
        }
    }
    public function editUserStatus(Request $request){
        DB::beginTransaction();
        try{
            $user = Auth::user();
            $id = $user->id;
            $update = User::find($id);
            $update->display_flag = $request->display_flag;
            $update->save();

            DB::commit();
            return response("success", 201);

        }catch(Exception $e){
            DB::rollback();
            return response($e, 400);
        }
    }
    public function logout(Request $request)
    {
        //auth()->guard('web')->logout();
        try{
            Auth::guard('sanctum')->user()->tokens()->delete();
            //$request->session()->invalidate();
            //$request->session()->regenerateToken();
            return response("logout success", 201);
        }catch(Exception $e){
            return response("Unauthenticated Error", 401);
        }


    }
    public function status(){
        return response("success", 201);
    }
    public function top(Request $request)
    {
        $code = $request->code;
        $userdata = User::where('code', $code)
        ->where("status",1)
        ->first();
        $user_companies = users_company::where("user_id",$userdata->id)->where("status",1)->get();
        $users_skill = users_skill::where("user_id",$userdata->id)->where("status",1)->get();
        $users_history = users_history::where("user_id",$userdata->id)->where("status",1)->get();
        return response(['user'=>$userdata,'company'=>$user_companies,'skill'=>$users_skill,'history'=>$users_history], 201);

    }
    public function upload(Request $request){
        $filename = uniqid().time().".jpg";
        $request->photo->storeAs('public/app/myImage', $filename);
        return response($filename, 201);
    }

    public function getRead(){
        $user = Auth::user();
        $id = $user->id;
        $result =
        Readed::select("users.*")
        ->selectRaw('DATE_FORMAT(users.created_at, "%Y/%m/%d") AS date')
        ->where(["readeds.user_id"=>$id,"readeds.status"=>1])
        ->join('users', 'readeds.user_read_code', '=', 'users.code')
        ->get();
        return response($result,200);
    }
    public function setRead(Request $request){
        $date = date('Y-m-d H:i:s');
        $user = Auth::user();
        $id = $user->id;
        Readed::where("user_id",$id)->update([
            "status"=>0,
            "created_at"=>$date
        ]);

        $insert = [];
        for($i = 0 ; $i < count($request[ 'data' ]) ; $i++){
            $insert[$i][ 'user_id' ] = $id;
            $insert[$i][ 'user_read_code' ] = $request[ 'data' ][$i][ 'user_read_code' ];
            $insert[$i][ 'readtime' ] = $date;
            $insert[$i][ 'created_at' ] = $date;
        }
        Readed::insert($insert);
        return response("ok",200);
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
