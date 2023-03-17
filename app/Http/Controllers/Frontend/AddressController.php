<?php

    namespace App\Http\Controllers\Frontend;

    use App\Enums\PageAlias;
    use App\Http\Controllers\Controller;
    use App\Http\Requests\Frontend\Address\SaveFormRequest;
    use App\Models\Client\Address;
    use Illuminate\Support\Facades\Redirect;
    use Illuminate\Support\Facades\Response;
    use Illuminate\Support\Facades\URL;

    class AddressController extends Controller
    {
    	private $options = ['anchor' => '#address-tab'];

        public function store(SaveFormRequest $request)
        {
            Address::create($this->getAttributes($request));

            return $this->redirect('success', __('frontend/profile/index.address_stored'), $this->options);
        }

        public function update(SaveFormRequest $request, Address $address)
        {
            $address->update($this->getAttributes($request));

            return redirect()->to(url()->previous() . '#address-tab')->with('success', __('frontend/profile/index.address_updated'));
        }

        private function getAttributes(SaveFormRequest $request)
        {
            $attributes = $request
                ->merge([
                    'client_id' => auth('web')->id(),
                ])
                ->all();

            return $attributes;
        }

        /**
         * @param \App\Models\Client\Address $address
         *
         * @return \Illuminate\Http\RedirectResponse
         */
        public function destroy(Address $address): \Illuminate\Http\RedirectResponse
        {
            $destroy = Address::destroy($address->id);

            return $destroy ? $this->redirect('success', __('frontend/profile/index.address_deleted'), $this->options) : $this->redirect('error', __('frontend/profile/index.error', $this->options));
        }
    }
