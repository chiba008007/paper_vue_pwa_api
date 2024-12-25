<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail;
use App\Mail\MailSend;
use App\Models\User;
class MailController extends Controller
{
    //
    public function send(Request $request)
    {
        $data = [];
        $data['email'] = $request->email;
        $data['name'] = $request->name;
        $data['body'] = $request->body;

        // お客様にメール
        Mail::send(new MailSend($data));

        // 管理者へメール
        $data['email'] = "admin@myselfpaper.online";
        Mail::send(new MailSend($data));

        return response("send", 201);
    }
    public function sameMail(Request $request){
        $email = User::select("email")->get();
        return response($email, 200);

    }
}
