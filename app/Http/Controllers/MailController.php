<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail;
use App\Mail\MailSend;
use App\Mail\MailSendAdmin;
use App\Models\User;
use Illuminate\Support\Facades\Log;
class MailController extends Controller
{
    //
    public function send(Request $request)
    {
        $data = [];
        $data['email'] = $request->email;
        $data['name'] = $request->name;
        $data['body'] = $request->body;

        Log::info('問い合わせメール[email]'.$data['email']);
        Log::info('問い合わせメール[name]'.$data['name']);
        Log::info('問い合わせメール[body]'.$data['body']);
        // お客様にメール
        Mail::send(new MailSend($data));

        // 管理者へメール
        $data['adminemail'] = "admin@myselfpaper.online";
        Mail::send(new MailSendAdmin($data));

        return response("send", 201);
    }
    public function sameMail(Request $request){
        $email = User::select("email")->get();
        return response($email, 200);

    }
}
