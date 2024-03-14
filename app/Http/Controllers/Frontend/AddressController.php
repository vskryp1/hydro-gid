<?php

namespace App\Http\Controllers\Frontend;

use App\Enums\PageAlias;
use App\Helpers\ShopHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\Address\SaveFormRequest;
use App\Models\Client\Address;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\URL;
use LisDev\Delivery\NovaPoshtaApi2;

class AddressController extends Controller
{
    private $options = ['anchor' => '#address-tab'];

    public function store(SaveFormRequest $request)
    {
        $address = Address::create($this->getAttributes($request));

        if($address->place_id != ''){
            $address->setCityName();
        }

        return $this->redirect('success', __('frontend/profile/index.address_stored'), $this->options);
    }

    public function update(SaveFormRequest $request, Address $address)
    {
        $address->update($this->getAttributes($request));

        if($address->place_id != ''){
            $address->setCityName();
        }

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
