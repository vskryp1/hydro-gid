<?php

    namespace App\Http\Controllers\Auth;

    use App\Events\RegistrationUserEvent;
    use App\Helpers\ShopHelper;
    use App\Http\Controllers\Controller;
    use App\Http\Requests\Frontend\Auth\RegisterRequest;
    use App\Models\Client\Client;
    use Illuminate\Auth\Events\Registered;
    use Illuminate\Foundation\Auth\RegistersUsers;
    use Illuminate\Support\Str;
    use RealRashid\SweetAlert\Facades\Alert;

    class RegisterController extends Controller
    {
        use RegistersUsers;

        public function __construct()
        {
            parent::__construct();

            $this->middleware('guest');
        }

        public function register(RegisterRequest $request)
        {
            event(new Registered($this->create($request->all())));
            return redirect()->back(301)->with('modal-success', __('auth.success_register'));
        }

        protected function create(array $data): ?Client
        {
            $client = new Client;

            $client->first_name      = $data['first_name'];
            $client->last_name       = $data['last_name'];
            $client->phone           = $data['phone'];
            $client->email           = $data['email'];
            $client->is_legal_entity = $data['is_legal_entity'];
            $client->company_name    = $data['company_name'] ?? null;
            $client->edrpou          = $data['edrpou'] ?? null;
            if(isset($data['password'])){
                $client->password        = bcrypt($data['password']);
            }

            $client->setRememberToken(Str::random(60));
            $client->setDiscount(json_decode(ShopHelper::setting('client_discount'), true));
            $client->save();

            return $client;
        }
    }
