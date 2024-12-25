<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Readed;
use App\Models\Registed;
use App\Models\users_company;
use App\Models\users_skill;
use App\Models\users_history;
use Illuminate\Support\Facades\Mail;
use App\Mail\MailRegistNew;
use App\Mail\MailRegistForget;
use App\Mail\MailRegist;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Consts\CommonConst;
use App\Models\forget;

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

        DB::beginTransaction();
        try{
            $user = Auth::user();

            $user_companies = users_company::where("user_id",$user->id)->where("status",1)->get();
            $users_skill = users_skill::where("user_id",$user->id)->where("status",1)->get();
            $users_history = users_history::where("user_id",$user->id)->where("status",1)->get();
            DB::commit();
            return response(['user'=>$user,'company'=>$user_companies,'skill'=>$users_skill,'history'=>$users_history], 201);
        }catch(Exception $e){
            DB::rollback();
            return response($e, 400);
        }
    }
    public function editUser(Request $request){

        $user = Auth::user();
        $id = $user->id;
        $update = User::find($id);
        $update->display_name = $request->display_name;
        $update->syozoku = $request->syozoku;
        $update->kana = $request->kana;
        if($request->myimage_path) $update->myimage_path = $request->myimage_path;
        $update->company_name = $request->company_name;
        if($request->company_image_path) $update->company_image_path = $request->company_image_path;
        $update->company_url = $request->company_url;
        $update->tel = $request->tel;
        $update->profile = $request->profile;
        $update->save();

        users_company::where("user_id",$user->id)->where("status",1)->update(['status' => 0]);
        users_skill::where("user_id",$user->id)->where("status",1)->update(['status' => 0]);
        users_history::where("user_id",$user->id)->where("status",1)->update(['status' => 0]);

        $companies = $request->company_address;
        $insert = [];
        $i=0;
        foreach($companies as $value){
            $insert[$i][ 'user_id'   ] = $user->id;
            $insert[$i][ 'address'   ] = $value['address'];
            $insert[$i][ 'map_url'   ] = $value['map_url'];
            $insert[$i][ 'order'     ] = $i+1;
            $insert[$i][ 'created_at'] = now();
            $i++;
        }
        users_company::insert($insert);

        $skills = $request->skills;
        $insert = [];
        $i=0;
        foreach($skills as $value){
            $insert[$i]['user_id' ] = $user->id;
            $insert[$i]['note'    ] = $value['note'];
            $insert[$i]['order'   ] = $i+1;
            $insert[$i]['created_at'] = now();
            $i++;
        }
        users_skill::insert($insert);


        $histories = $request->histories;
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
        return response("success", 200);
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
    public function setRegist(Request $request){
        $unique = uniqid().rand();
        $insert = [];
        $insert['code'] = $unique;
        $insert['name'] = $request->name;
        $insert['mail'] = $request->mail;
        $insert['tel'] = $request->tel;
        $insert['post'] = $request->post;
        $insert['pref'] = $request->pref;
        $insert['address'] = $request->address;
        $insert['created_at'] = date("Y-m-d H:i:s");
        $insert['updated_at'] = date("Y-m-d H:i:s");
        if(Registed::insert($insert)){

            $data = [];
            $data[ 'email' ] = $request->mail;
            $data[ 'name' ] = $request->name;
            $data[ 'registUrl' ] = CommonConst::ADMINDOMAIN."/register?c=".$unique;
            try{
                Mail::send(new MailRegistNew($data));
            }catch(Exception $e){
                return false;
            }
            return response("success", 201);
        }else{
            return response("error", 400);
        }
    }
    public function getRegistData(Request $request)
    {
        $hour = date("Y-m-d H:i:s",strtotime("-1 hour"));
        $code = $request->code;
        $userdata = Registed::where('code', $code)
        ->where("status",1)
        // ->where("created_ts",">",$hour)
        ->first();
        return response($userdata, 201);
    }
    public function setRegistData(Request $request)
    {
        $code = $request->code;
        $userdata = Registed::where('code', $code)->first();
        $userdata->status='2';
        $userdata->save();
        DB::beginTransaction();
        try{

            $insert = [];
            $code = uniqid();
            $insert['code'] = $code;
            $insert['name'] = $request->name;
            $insert['display_name'] = $request->display_name;
            $insert['email'] = $request->email;
            $insert['password'] = "password";
            $insert['syozoku'] = $request->syozoku;
            $insert['kana'] = $request->kana;
            $insert['address'] = $request->address;
            $insert['tel'] = $request->tel;
            $insert['post'] = $request->post;
            $insert['pref'] = $request->pref;
            $insert['myimage_path'] = $request->myimage_path;
            $insert['company_image_path'] = $request->company_image_path;
            $insert['company_name'] = $request->company_name;
            $insert['company_url'] = $request->company_url;
            $insert['profile'] = $request->profile;
            $insert['status'] = 3; // 仮登録
            $insert['created_at'] = date("Y-m-d H:i:s");
            $insert['updated_at'] = date("Y-m-d H:i:s");
            User::insert($insert);

            $lastId = DB::getPdo()->lastInsertId();
            $companies = $request->company_address;
            $skills = $request->skills;
            $histories = $request->histories;

            $insert = [];
            $i=0;
            foreach($companies as $value){
                if($value['value']){
                    $insert[$i]['user_id'] = $lastId;
                    $insert[$i]['address'] = $value['value'];
                    $insert[$i]['map_url'] = $value['map_url'];
                    $insert[$i]['order'] = $i+1;
                    $insert[$i]['created_at'] = now();
                    $i++;
                }
            }
            if(count($insert) > 0) users_company::insert($insert);
            $insert = [];
            $i=0;
            foreach($skills as $value){
                if($value['value']){
                    $insert[$i]['user_id'] = $lastId;
                    $insert[$i]['note'] = $value['value'];
                    $insert[$i]['order'] = $i+1;
                    $insert[$i]['created_at'] = now();
                    $i++;
                }
            }
            if(count($insert) > 0) users_skill::insert($insert);

            $insert = [];
            $i=0;
            foreach($histories as $value){
                if($value['value']){
                    $insert[$i]['user_id'] = $lastId;
                    $insert[$i]['title'] = $value['title'];
                    $insert[$i]['note'] = $value['value'];
                    $insert[$i]['order'] = $i+1;
                    $insert[$i]['created_at'] = now();
                    $i++;
                }
            }
            if(count($insert) > 0) users_history::insert($insert);

            DB::commit();
            $data = [];
            $data[ 'email' ] = $request->email;
            $data[ 'name' ] = $request->name;
            $data[ 'subject' ] = "新規申し込みありがとうございます。";
            Mail::send(new MailRegist($data));

            $data[ 'email' ] = CommonConst::ADMINMAIL;
            $data[ 'subject' ] = "新規申し込みがありました。パスワード[password]";
            Mail::send(new MailRegist($data));
            return response("success", 201);
        }catch(Exception $e){
            DB::rollback();
            return response($e, 400);
        }
    }

    public function status(){
        $update = User::find(1)->get();
var_dump($update);
        return response("success", 201);
    }
    public function top(Request $request)
    {
        $code = $request->code;
        $userdata = User::where('code', $code)
        ->where("status",1)
        ->first();
        $user_companies = users_company::where("user_id",$userdata->id)->where("status",1)->get();
        foreach($user_companies as $key=>$value){
            $user_companies[$key] = $value;
            $user_companies[$key]['map_url_code'] = self::get_googlemap_url($value->map_url);
        }
        $users_skill = users_skill::where("user_id",$userdata->id)->where("status",1)->get();
        $users_history = users_history::where("user_id",$userdata->id)->where("status",1)->get();
        return response(['user'=>$userdata,'company'=>$user_companies,'skill'=>$users_skill,'history'=>$users_history], 201);

    }

    private function get_googlemap_url($address){
       // $address = urlencode($address);
        $address = "東京タワー";
        $zoom = 15;
        return "https://maps.google.co.jp/maps?q={$address}&z={$zoom}";
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
    public function forgetForm(Request $request){
        $forgetcode = $request->forgetcode;
        $forget = forget::where("forgetcode",$forgetcode)->where("status",1)->first();

        DB::beginTransaction();
        try{
            $user_id = $forget->user_id;
            $user = User::find($user_id);
            $code = $user->code;
            User::where("id",$user->id)->update([
                "password"=>password_hash($request->password,PASSWORD_DEFAULT),
                "updated_at"=>date('Y-m-d H:i:s')
            ]);
            forget::where("forgetcode",$forgetcode)->where("status",1)->update(['status'=>2]);

            DB::commit();
            return response($code, 201);
        }catch(Exception $e){
            DB::rollback();
            return response($e, 400);
        }
    }
    public function forget(Request $request){
        $email = $request->email;
        $userdata = User::where("email",$email)->where("status",1)->first();
        $unique = md5(uniqid(rand(), true));
        $insert = [];
        $insert['forgetCode'] = $unique;
        $insert[ 'email' ] = $userdata['email'];
        $insert[ 'user_id' ] = $userdata[ 'id' ];
        $insert[ 'status' ] = 1; // 有効
        $insert[ 'created_at' ] = date('Y-m-d H:i:s');
        $insert[ 'updated_at' ] = date('Y-m-d H:i:s');
        forget::insert($insert);

        $data = [];
        $data[ 'email' ] = $email;
        $data[ 'name' ] = $userdata[ 'name' ];
        $data[ 'registUrl' ] = CommonConst::ADMINDOMAIN."/forgetForm?c=".$unique;
        try{
            Mail::send(new MailRegistForget($data));
        }catch(Exception $e){
            return false;
        }

        return response("success",200);
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
    public function edit(Request $request,User $user,$id)
    {
        //
        $users = User::find($id);
        $users_companies = users_company::where("user_id",$users->id)->where("status",1)->get();
        $users_companies_count = users_company::where("user_id",$users->id)->where("status",1)->count();
        $users->users_companies = $users_companies;
        $users->users_companies->count = ($request->sel)?$request->sel:$users_companies_count;

        $users_skill = users_skill::where("user_id",$users->id)->where("status",1)->get();
        $users_skill_count = users_skill::where("user_id",$users->id)->where("status",1)->count();
        $users->users_skill = $users_skill;
        $users->users_skill->count = ($request->skillsel)?$request->skillsel:$users_skill_count;

        $users_histories = users_history::where("user_id",$users->id)->where("status",1)->get();
        $users_histories_count = users_history::where("user_id",$users->id)->where("status",1)->count();
        $users->users_histories = $users_histories;
        $users->users_histories->count = ($request->historysel)?$request->historysel:$users_histories_count;


        return view('User', compact('users'));
    }
    public function edited(Request $request,User $user,$id)
    {
        if($request->basic_button){
            $update = User::find($id);
            $update->code = $request->code;
            $update->display_name = $request->display_name;
            $update->syozoku = $request->syozoku;
            $update->kana = $request->kana;
            if($request->myimage_path){
                $file_name = uniqid()."_".$request->file('myimage_path')->getClientOriginalName();
                $request->file('myimage_path')->storeAs( CommonConst::IMAGEDIR,$file_name);
                $update->myimage_path = config('app.url').CommonConst::IMAGEPATH.$file_name;
            }
            $update->company_name = $request->company_name;
            if($request->company_image_path){
                $file_name = uniqid()."_".$request->file('company_image_path')->getClientOriginalName();
                $request->file('company_image_path')->storeAs( CommonConst::IMAGEDIR,$file_name);
                $update->company_image_path = config('app.url').CommonConst::IMAGEPATH.$file_name;
            }
            $update->company_url = $request->company_url;
            $update->tel = $request->tel;
            $update->profile = $request->profile;
            $update->email = $request->email;
            $update->save();

        }

        if($request->company_button){
            users_company::where('user_id', $id)->delete();

            $insert = [];
            $i=0;
            foreach($request->address as $value){

                $insert[$i]['user_id'] = $id;
                $insert[$i]['address'] = $value;
                $insert[$i]['map_url'] = $request->map_url[$i];
                $insert[$i]['order'] = $i+1;
                $insert[$i]['created_at'] = now();
                $insert[$i]['updated_at'] = now();
                $i++;

            }
            if(count($insert) > 0) users_company::insert($insert);
        }

        if($request->user_skills){
            users_skill::where('user_id', $id)->delete();
            $insert = [];
            $i=0;
            foreach($request->note as $value){
                $insert[$i]['user_id'] = $id;
                $insert[$i]['note'] = $value;
                $insert[$i]['order'] = $i+1;
                $insert[$i]['created_at'] = now();
                $insert[$i]['updated_at'] = now();
                $i++;
            }
            if(count($insert) > 0) users_skill::insert($insert);
        }

        if($request->user_history){
            users_history::where('user_id', $id)->delete();
            $insert = [];
            $i=0;
            foreach($request->note as $key=>$value){
                $insert[$i]['user_id'] = $id;
                $insert[$i]['title'] = $request->title[$key];
                $insert[$i]['note'] = $value;
                $insert[$i]['order'] = $i+1;
                $insert[$i]['created_at'] = now();
                $insert[$i]['updated_at'] = now();
                $i++;
            }
            if(count($insert) > 0) users_history::insert($insert);
        }
        return redirect()->route('edit', ['id' => $id]);
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
