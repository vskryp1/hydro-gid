<?php

    namespace App\Http\Controllers\Backend\Users;

    use App\Enums\DeliveryType;
    use App\Http\Controllers\Controller;
    use App\Http\Requests\Backend\Addresses\SaveFormRequest;
    use App\Models\Client\Address;
    use App\Models\Client\Client;
    use App\Models\Order\Delivery;
    use App\Models\Order\DeliveryPlace;
    use Illuminate\Support\Facades\Redirect;

    class AddressController extends Controller
    {
        public function create(Client $client)
        {
            $deliveryId     = Delivery::whereType(DeliveryType::COURIER_NP)->first()->id;
            return view('backend.clients.addresses.create', compact('client', 'deliveryId'));
        }

        public function store(SaveFormRequest $request, Client $client)
        {
            $data             = $request->all();
            $data['place_id'] = DeliveryPlace::where('api_id', $data['place_id'])->first()->id;
            $address          = $client->addresses()->create($data);

            if ($request->input('action') === 'continue') {
                return Redirect::route('backend.clients.addresses.edit', [
                    'client'  => $client,
                    'address' => $address,
                ])->with('success', __('backend.address_stored'));
            }

            return Redirect::route('backend.clients.edit', [
                'client' => $client,
            ])->with('success', __('backend.address_stored'));
        }

        public function edit(Client $client, Address $address)
        {
            $deliveryPlaces = [$address->delivery_place->api_id => $address->delivery_place->name];
            $deliveryId     = Delivery::whereType(DeliveryType::COURIER_NP)->first()->id;

            return view('backend.clients.addresses.edit', compact('client', 'address', 'deliveryPlaces', 'deliveryId'));
        }

        public function update(SaveFormRequest $request, Client $client, Address $address)
        {
            $data             = $request->all();
            $data['place_id'] = DeliveryPlace::where('api_id', $data['place_id'])->first()->id;
            $address->update($data);

            if ($request->input('action') === 'continue') {
                return Redirect::route('backend.clients.addresses.edit', [
                    'client'  => $client,
                    'address' => $address,
                ])->with('success', __('backend.address_updated'));
            }

            return Redirect::route('backend.clients.edit', [
                'client' => $client,
            ])->with('success', __('backend.address_updated'));
        }

        public function destroy(Client $client, Address $address)
        {
            $address->forceDelete();

            return Redirect::route('backend.clients.edit', [
                'client' => $client,
            ])->with('success', __('backend.address_deleted'));
        }

    }
