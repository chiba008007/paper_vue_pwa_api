<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail;
use App\Mail\MailSend;

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
        $data['email'] = "admin@sample.jp";
        Mail::send(new MailSend($data));

        return response("send", 201);
    }
}
