<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ActivationMailer;
use App\User;
use Sentinel;
use Activation;

class ActivationController extends Controller
{
    /**
     * appending activation code in the database for the registered user
     * @param  $user
     * @return      
     */
    public static function createActivation($user) {
	    // assign this user to the activation table ans set the random activation code
	    $activation = Activation::create($user);

	    return $activation;
    }


    /**
     * a method for sending a mail with activation code
     * @param  $userFname     
     * @param  $userEmail     
     * @param  $activationCode              
     */
    public static function Mailer($userFname, $userEmail, $activationCode)
    {
        // mailing this user with activation code
        Mail::to($userEmail)->send(new ActivationMailer($userFname, $userEmail, $activationCode));
    }


	/**
	 * get function fired when the user click his activation email
	 * @param  $email         
	 * @param  $activationCode
	 * @return                
	 */
    public function activate($email, $activationCode)
    {
    	$user = User::where('email', $email)->first();

    	if (Activation::complete($user, $activationCode))
    		return redirect('/login')->with('activated', 'You\'ve successfully activated your account');
    	else
    		abort(404);
    }

}
