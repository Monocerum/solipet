<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Crypt;

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

    protected function authenticated(Request $request, $user)
    {
        if ($user->is_admin) {
            return redirect('/admin');
        }

        return redirect('/home');
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request)
    {
        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            // Handle remember me functionality
            if ($request->filled('remember')) {
                $this->storeRememberCredentials($request);
            } else {
                $this->clearRememberCredentials();
            }

            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    /**
     * Store encrypted credentials for remember me functionality
     */
    protected function storeRememberCredentials(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        $encryptedCredentials = Crypt::encryptString(json_encode($credentials));
        
        Cookie::queue('remember_credentials', $encryptedCredentials, 60 * 24 * 30); // 30 days
    }

    /**
     * Clear remember me credentials
     */
    protected function clearRememberCredentials()
    {
        Cookie::queue(Cookie::forget('remember_credentials'));
    }

    /**
     * Get remembered credentials if they exist
     */
    public function getRememberedCredentials()
    {
        $cookie = request()->cookie('remember_credentials');
        
        if ($cookie) {
            try {
                $decrypted = Crypt::decryptString($cookie);
                return json_decode($decrypted, true);
            } catch (\Exception $e) {
                // If decryption fails, clear the cookie
                Cookie::queue(Cookie::forget('remember_credentials'));
                return null;
            }
        }
        
        return null;
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        $rememberedCredentials = $this->getRememberedCredentials();
        
        return view('auth.login', compact('rememberedCredentials'));
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }
}
