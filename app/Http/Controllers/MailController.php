<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\FirstMail;
use Sentinel;

class MailController extends Controller
{
    public function index()
    {
    	return view('mails.mailing');
    }

    public function sendMails()
    {
    	$message = 'This is the first mail from laravel';

    	Mail::to(Sentinel::getUser()->email)->send(new FirstMail($message));

    	return back()->with('mail_success', 'Email sent successfully.');
    }
}
