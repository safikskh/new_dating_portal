<?php

namespace App\Http\Controllers\Auth;

use Session;
use App\User;
use DateTime;
use App\Enums\Sex;
use Carbon\Carbon;
use App\Models\Portal;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\PortalJoinUser;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use App\Notifications\TemplateEmail;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    protected $redirectTo = '/home';
    // protected $redirectTo = '/welcome/profile';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectToProvider(Request $request)
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Obtain the user information from facebook.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback(Request $request)
    {
      
        $userSocial = Socialite::driver('facebook')->stateless()->user();

        if ($userSocial) {
            $findUser = User::where('email', $userSocial->email)->first();
            if($findUser) {
                Auth::login($findUser);
                return redirect()->route('home');
            }else{

                session()->put('fbSignup1',[
                    'type' => 'facebook',
                    'email' => $userSocial->email,
                    'password' => Str::random(8),
                    'profilePicture' => $userSocial->avatar_original,                
                ]);
                return redirect()->route('signup.show.fbPortals');
            }
        }else{
            return redirect()->back();
        }
        
    }


}
