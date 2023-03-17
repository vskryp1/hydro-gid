<?php

    namespace App\Http\Controllers\Auth;

    use App\Enums\PageAlias;
    use App\Http\Controllers\Controller;
    use App\Models\Client\Client;
    use App\Models\Client\Temp_Client_Orders;
    use App\Models\Order\Order;
    use Illuminate\Auth\Access\AuthorizationException;
    use Illuminate\Auth\Events\Verified;
    use Illuminate\Foundation\Auth\VerifiesEmails;
    use Illuminate\Http\Request;

    class VerificationController extends Controller
    {
        use VerifiesEmails;

        public function __construct()
        {
            parent::__construct();

            $this->middleware('signed')->only('verify');
            $this->middleware('throttle:6,1')->only('verify', 'resend');
        }

        /**
         * Mark the authenticated user's email address as verified.
         *
         * @param  \Illuminate\Http\Request  $request
         * @return \Illuminate\Http\Response
         */
        public function verify(Request $request)
        {
            $user = Client::find($request->route('id'));

            if ($user->hasVerifiedEmail()) {
                return redirect('/')->with('success', __('auth.already_verified'));
            }

            if ($user->markEmailAsVerified()) {
                event(new Verified($user));

                $this->joinOrders($user);
            }

            return redirect('/')->with('success', __('auth.success_verify'));
        }

        private function joinOrders(Client $client)
        {
            $tempOrders = Temp_Client_Orders::whereEmail($client->email)->get();

            foreach ($tempOrders as $tempOrder) {
                $order = Order::where('id', $tempOrder->order_id)->first();
                $order->client_id = $client->id;
                $order->temp_client_id = null;
                $order->save();
            }

            Temp_Client_Orders::whereEmail($client->email)->delete();
        }
    }
