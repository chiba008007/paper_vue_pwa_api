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

        // $obj = new MailSend($data['name'], $data['body']);
        // Mail::to($data['email'])->send($obj);

        // return response("send", 201);

         return response( Mail::send(new MailSend($data)));
        // return response("send", 201);
    }
}
