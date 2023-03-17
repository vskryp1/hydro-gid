<?php

    namespace App\Http\Controllers\Auth;

    use App\Http\Controllers\Controller;
    use App\Http\Requests\Frontend\Auth\ResetPasswordRequest;
    use App\Notifications\ResetPasswordEmail;
    use Illuminate\Foundation\Auth\ResetsPasswords;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Password;
    use Illuminate\Support\Str;

    class ResetPasswordController extends Controller
    {
        use ResetsPasswords;

        public function __construct()
        {
            parent::__construct();

            $this->middleware('guest');
        }

        /**
         * Display the password reset view for the given token. If no token is present, display the link request form.
         *
         * @param  \Illuminate\Http\Request  $request
         * @param  null                      $token
         *
         * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
         * @throws \Exception
         */
        public function showResetForm(Request $request, $token = null)
        {
            return view('frontend.templates.auth.passwords.reset', [
                'token'       => $token,
                'email'       => $request->input('email'),
            ]);
        }

        public function broker()
        {
            return Password::broker('clients');
        }

        /**
         * Get the response for a successful password reset.
         *
         * @param  \Illuminate\Http\Request  $request
         * @param                            $response
         *
         * @return \Illuminate\Http\RedirectResponse
         */
        protected function sendResetResponse(Request $request, $response)
        {
            alert(
                __('frontend/alerts/index.reset_password.title'),
                __('frontend/alerts/index.reset_password.message'),
                'success'
            )->addImage(asset('assets/frontend/images/logo@2.png'))->position('center');

            return redirect()->route('frontend.page', ['slug' => 'account'], 301);
        }

        /**
         * Get the response for a failed password reset.
         *
         * @param  \Illuminate\Http\Request  $request
         * @param                            $response
         *
         * @return \Illuminate\Http\RedirectResponse
         */
        protected function sendResetFailedResponse(Request $request, $response)
        {
            alert(
                __('frontend/alerts/index.reset_password.title'),
                trans($response),
                'warning'
            )->addImage(asset('assets/frontend/images/logo@2.png'))->position('center');

            return redirect()->back(301);
        }
    }
