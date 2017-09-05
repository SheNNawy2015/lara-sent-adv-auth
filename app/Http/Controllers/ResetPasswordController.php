<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResetMailer;
use App\User;
use Reminder;
use Sentinel;
use Validator;

class ResetPasswordController extends Controller
{
	// reset password form
    public function forgotPassword()
    {
    	return view('authentication.forgot-password');
    }


    public function postForgotPassword(Request $request)
    {
    	// validation
    	$rules = ['email' => 'required|email|min:7'];

    	$validator = Validator::make($request->all(), $rules)->validate();


    	$user = User::where('email', $request->email)->first();

    	// check if the user with that email exists [fake message if the user doesn't exist]
    	if (count ($user) == 0)
    		return redirect('/login')->with('reset', 'Check your email address to reset your password.');

    	// check if there exist a reminder code for this user before or not
    	// if so, return that old reminder code else, create new remider code 
    	$reminder = Reminder::exists($user)?: Reminder::create($user);

    	// send the remider code to the user's email
    	$mailer = $this->resetMailer($user->first_name, $user->email, $reminder->code);

    	return redirect('/login')->with('reset', 'Check your email address to reset your account password.');

    }


    // reset password form
    public function resetPassword($email, $resetCode)
    {
    	$user = User::where('email', $email)->first();

    	// check if the user with the incoming mail exists
    	if (count ($user) == 0)
    		abort(404);
    	
    	// check if the reminder code for this user is existed
    	if ($reminder = Reminder::exists($user))
    	{
    		// check if the incoming code equals the DB remider code for this user
    		if ($resetCode == $reminder->code)
    			return view('authentication.reset-password');
    		else
    			abort(404);
    	}
    	else
    		abort(404);
    }


    // reset password [post request with the new password]
    public function postResetPassword(Request $request, $email, $resetCode)
    {
    	$rules = [
    		'password' => 'required|min:5|max:15|confirmed',
    		'password_confirmation' => 'required|min:5|max:15',
    	];

    	Validator::make($request->all(), $rules)->validate();

    	$user = User::where('email', $email)->first();

    	// check if the user with the incoming mail exists
    	if (count ($user) == 0)
    		abort(404);
    	
    	// check if the reminder code for this user is existed
    	if ($reminder = Reminder::exists($user))
    	{
    		// check if the incoming code equals the DB remider code for this user
    		if ($resetCode == $reminder->code)
    		{
    			if (Reminder::complete($user, $resetCode, $request->password))
    				return redirect('/login')->with('reset_done', 'You\'ve successfully reset your password');
    		}
    		else
    			abort(404);
    	}
    	else
    		abort(404);
    }


    /**
     * reset mailer method
     * @param  $userFname
     * @param  $userEmail
     * @param  $resetCode
     * @return           
     */
    private function resetMailer($userFname, $userEmail, $resetCode)
    {
        // mailing this user with reset code
        Mail::to($userEmail)->send(new ResetMailer($userFname, $userEmail, $resetCode));
    }
}
