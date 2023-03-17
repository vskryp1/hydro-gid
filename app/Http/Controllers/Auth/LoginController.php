<?php

    namespace App\Http\Controllers\Auth;

    use App\Enums\PageAlias;
    use App\Http\Controllers\Controller;
    use App\Http\Requests\Frontend\Auth\LoginRequest;
    use App\Models\Client\Client;
    use Illuminate\Foundation\Auth\AuthenticatesUsers;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;

    class LoginController extends Controller
    {
        use AuthenticatesUsers;

        public function __construct()
        {
            parent::__construct();

            $this->middleware('guest')->except('logout');
        }

        public function showLoginForm()
        {
            return redirect()->to(DIRECTORY_SEPARATOR)->with('open-modal', true);
        }

        public function login(LoginRequest $request)
        {
            if ($this->attemptLogin($request) ) {
                $client = Client::whereEmail($request->input('email'))->first();

                if (!$client->hasVerifiedEmail()) {
                    $this->logout($request);

                    return back(301)->withError(__('auth.not_verified'));
                }

                if (!$client->is_active) {
                    $this->logout($request);

                    return back(301)->withError(__('auth.banned'));
                }
    
                return redirect()->back()->with('success', __('auth.login_success'));
            }

            return redirect()->back()->withError(__('auth.failed'));
        }
    
        /**
         * Log the user out of the application.
         *
         * @param  \Illuminate\Http\Request  $request
         * @return \Illuminate\Http\Response
         */
        public function logout(Request $request)
        {
            $this->guard()->logout();
        
            $request->session()->invalidate();

            return $this->loggedOut($request) ?: redirect(app()->getLocale())->header('Cache-Control','nocache, no-store, max-age=0, must-revalidate')
	            ->header('Pragma','no-cache')
	            ->header('Expires','Fri, 01 Jan 1990 00:00:00 GMT');
        }
    }
