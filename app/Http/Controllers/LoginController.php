<?php

namespace App\Http\Controllers;
use Cartalyst\Sentinel\Checkpoints\NotActivatedException;
use Cartalyst\Sentinel\Checkpoints\ThrottlingException;
use Illuminate\Http\Request;
use Sentinel;
use Session;
use Validator;


class LoginController extends Controller
{
    public function login()
    {
    	return view('authentication.login');
    }

    public function postLogin(Request $request)
    {
    	$rules = [
    		'email' => 'required|email|min:10',
    		'password' => 'required|min:5|max:15',
    	];

    	$validator = Validator::make($request->all(), $rules)->validate();

        try {

            $rememberMe = false;

            if (isset ($request->remember_me))
                $rememberMe = true;

            if (Sentinel::authenticate($request->all(), $rememberMe))
                return response()->json([
                    'success' => 'Success login',
                    'redirection' => '/home'
                    ]);
            else 
                return response()->json(['failed' => 'Invalid email and/or password'], 500);

        } catch (ThrottlingException $e) {

            $delay = $e->getDelay();

            return response()->json(['failed' => 'You\'re banned for ' . $delay . ' seconds.'], 500);

        } catch (NotActivatedException $e) {
            
            return response()->json(['failed' => "Your account is not activated yet, please check your email address"], 500);
        }
    	
    }

    public function logout()
    {
    	Sentinel::logout();
    	return redirect('/login');
    }
}
