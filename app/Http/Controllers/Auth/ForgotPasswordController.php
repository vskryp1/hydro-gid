<?php

    namespace App\Http\Controllers\Auth;

    use App\Events\ResetPasswordEvent;
    use App\Http\Controllers\Controller;
    use App\Models\Client\Client;
    use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Facades\Password;

    class ForgotPasswordController extends Controller
    {
        use SendsPasswordResetEmails;

        public function __construct()
        {
            parent::__construct();

            $this->middleware('guest');
        }

        /**
         * Display the form to request a password reset link.
         *
         * @return \Illuminate\Http\RedirectResponse
         */
        public function showLinkRequestForm()
        {
            return redirect()->route('frontend.page');
        }

        /**
         * Get the response for a successful password reset link.
         *
         * @param  \Illuminate\Http\Request  $request
         * @param                            $response
         *
         * @return \Illuminate\Http\RedirectResponse
         */
        protected function sendResetLinkResponse(Request $request, $response)
        {
            alert(
                __('frontend/alerts/index.forgot_password.title'),
                __('frontend/alerts/index.forgot_password.message'),
                'success'
            )->addImage(asset('assets/frontend/images/logo@2.png'))->position('center');

            return back(301);
        }

        /**
         * Get the response for a failed password reset link.
         *
         * @param  \Illuminate\Http\Request  $request
         * @param                            $response
         *
         * @return \Illuminate\Http\RedirectResponse
         */
        protected function sendResetLinkFailedResponse(Request $request, $response)
        {
            alert(
                __('frontend/alerts/index.forgot_password.title'),
                trans($response),
                'warning'
            )->addImage(asset('assets/frontend/images/logo@2.png'))->position('center');

            return redirect()->back(301);
        }

        /**
         * Send a reset link to the given user.
         *
         * @param  \Illuminate\Http\Request  $request
         * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
         */
        public function sendResetLinkEmail(Request $request)
        {
            $this->validateEmail($request);

            // We will send the password reset link to this user. Once we have attempted
            // to send the link, we will examine the response then see the message we
            // need to show to the user. Finally, we'll send out a proper response.
            $response = $this->broker()->sendResetLink(
                $this->credentials($request)
            );

            return $response == Password::RESET_LINK_SENT
                ? $this->sendResetLinkResponse($request, $response)
                : $this->sendResetLinkFailedResponse($request, $response);
        }
    }