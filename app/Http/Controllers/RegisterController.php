<?php

namespace App\Http\Controllers;
use App\Http\Controllers\ActivationController;
use Illuminate\Http\Request;
use Sentinel;
use Validator;

class RegisterController extends Controller
{

    // registration form
    public function register()
    {
    	return view('authentication.register');
    }

    // post the regestration request
    public function postRegister(Request $request)
    {
    	$rules = [
    		'first_name' => 'required|min:3|max:10',
    		'last_name' => 'required|min:3|max:10',
    		'email' => 'required|email|unique:users|min:7',
    		'location' => 'required|min:3|max:25',
    		'password' => 'required|min:5|max:15|confirmed',
    		'password_confirmation' => 'required|min:5|max:15|'
    	];

        // make validation 
    	$validator = Validator::make($request->all(), $rules)->validate();

        // register the user and make him activated
        // $user = Sentinel::registerAndActivate($request->all())
         
        // register the user without being activated
    	$user = Sentinel::register($request->all());

        // assign this user to the activation table ans set the random activation code
        $activation = ActivationController::createActivation($user);

        // get the rule by slug (name of the rule)
        $role = Sentinel::findRoleBySlug('user');

        // give the new registered user a role of ordinary user.
        $role->users()->attach($user);
        
        // calling mailer method
        ActivationController::Mailer($user->first_name, $user->email, $activation->code);

        // redirect to login page with a message
    	return redirect('/login')->with('not_activated', 'Check your email address to activate your account');
    }

    
}

