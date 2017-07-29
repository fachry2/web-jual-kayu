<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Notifications\Messages\MailMessage;

use Mail;

class MailController extends Controller
{
    public function basic_email(){
        $data = ['name' => 'Muhammad Al-Pandi'];
        Mail::send(['text' => 'mail'], $data, function($message){
            $message->to('mh2.alpandi@yahoo.co.id', 'Muhammad Al-Pandi')->subject('Coba aja');
            $message->from('m.alpandi57@gmail.com', 'Pandi');
        });

        return "Email terkirim";
    }
    
    public function html_email(){
        $email = 'hckraza@gmail.com';
        $data = ['link' => 'http://facebook.com'];

        Mail::send(['html' => 'home'], $data, function($message) use ($email)
        {
            $message->to($email, 'Muhammad Al-Pandi')->subject('Coba aja HTML');
            $message->from('m.alpandi57@gmail.com', 'FURNITURE');
        });

        return "Email terkirim";
    }
}
