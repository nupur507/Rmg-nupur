<?php
namespace App\Http\Controllers\Franchise\Auth;

use App\Models\GeneralSetting;
use App\Http\Controllers\Controller;
use App\Models\Franchise;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    public $redirectTo = 'franchise';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('franchise.guest')->except('logout');
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        $page_title = "Franchise Login";
        return view('franchise.auth.login', compact('page_title'));
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('franchise');
    }

    public function username()
    {
        return 'franchise_id';
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);

        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }

        $franchise = Franchise::where('franchise_id', $request->franchise_id)->first();

        if($franchise != null ){
            if (Hash::check($request->password, $franchise->password)) {
                if ($this->attemptLogin($request)) {
                    return $this->sendLoginResponse($request);
                }
            } else {
                $notify[] = ['error', 'Invalid Franchise Id or Password!'];
                return redirect()->back()->withNotify($notify)->withInput();
            }
        } else {
            $notify[] = ['error', 'Franchise Not Found!'];
            return redirect()->back()->withNotify($notify);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);
    }

    public function logout(Request $request)
    {
        $this->guard('franchise')->logout();
        $request->session()->invalidate();
        return $this->loggedOut($request) ?: redirect('/franchise');
    }

    public function resetPassword()
    {
        $page_title = 'Account Recovery';
        return view('franchise.reset', compact('page_title'));
    }
}
