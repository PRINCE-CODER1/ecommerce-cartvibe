<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\DemoMail;

class MailController extends Controller
{
    public function testingmail(){
        $mailData = [
            'title' => 'Mail from Prince',
            'body' => 'This is for testing email using smtp',
        ];
        Mail::to('princek002003@gmail.com')->send(new DemoMail($mailData));
        return redirect('/');
    }
}
