<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = '/home';
    public function redirectTo(){
        
        // Get Access Role
        $role = Auth::user()->access_role; 
        
        // Check Access Role
        switch ($role) {
            case 'ADMIN':
                    return '/admin/home';
                break;
            case 'STUDENT':
                    return '/student/home';
                break; 
            default:
                    return '/login'; 
                break;
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('guest')->except('logout');
    }

    /*protected function authenticated(Request $request, $user)
    {
        return $this->RedirectBasedInRole($request, $user);
    }*/

    

   
}
