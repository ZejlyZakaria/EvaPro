<?php

namespace App\Http\Controllers;

use App\Mail\SendEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function mailsend(){
        $details = [
            'title' => 'Title: Mail from Zakaria Zejly',
            'body' => 'Body: this is for testing email using stmp'
        ];
        Mail::to('zejly12@gmail.com')->send(new SendEmail($details));
        return view('emails.thanks');
    }
}
