<?php

namespace App\Http\Controllers\Frontend;

use App\Enums\ServiceType;
use App\Events\NewClientCallbackEvent;
use App\Events\OrderBuyClickEvent;
use App\Helpers\ShopHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\FeedbackRequest;
use App\Http\Requests\Frontend\ServiceOrder\BuyPerClickRequest;
use App\Http\Requests\Frontend\ServiceOrder\SaveFormRequest;
use App\Http\Requests\Frontend\SubscribeRequest;
use App\Mail\Frontend\FeedbackMail;
use App\Models\Order\OneClickOrders;
use App\Models\Order\ServiceOrder;
use App\Models\Product\Product;
use App\Models\Subscriber;
use Illuminate\Support\Facades\Mail;

class ShopController extends Controller
{
    /**
     * @param \App\Http\Requests\Frontend\ServiceOrder\SaveFormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function callback(SaveFormRequest $request)
    {
        $serviceOrder = ServiceOrder::create($request->all());

        event(new NewClientCallbackEvent($serviceOrder));

        $message = '';
        switch ($request->input('type')) {
            case ServiceType::ORDER:
                $message = __('frontend/service/index.service_ordered');

                break;
            case ServiceType::QUESTION:
                $message = __('frontend/service/index.thank_you_for_question');

                break;
            case ServiceType::CALLBACK:
            case ServiceType::CONTACT:
        }

        if ($message != '') {
            return $this->redirect('success', $message);
        }

        if ($serviceOrder->call_me) {
            return $this->redirect('success', __('frontend.callback_sent'));
        }
        return $this->redirect('success', __('frontend.form_submitted'));
    }

    public function feedback(FeedbackRequest $request)
    {
        $data           = $request->all();
        $data['locale'] = app()->getLocale();

        Mail::to(ShopHelper::feedback_emails())
            ->queue((new FeedbackMail($data))->onQueue('default'));

        return $this->redirect('success', __('frontend.feedback_sent'));
    }

    public function subscribe(SubscribeRequest $request)
    {
        Subscriber::updateOrCreate(['email' => $request->input('email')]);

        return $this->redirect('success', __('frontend.subscribe_sent'));
    }

    public function unsubscribe(string $id)
    {
        Subscriber::findOrFail($id)->delete();

        return redirect()->route('frontend.page')->with('success', __('frontend.unsubscribe_sent'));
    }


    /**
     *
     *
     * @param \App\Http\Requests\Frontend\ServiceOrder\BuyPerClickRequest $request
     *
     * @param \App\Models\Order\OneClickOrders                            $oneClickOrders
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function buyPerClick(BuyPerClickRequest $request, OneClickOrders $oneClickOrders): \Illuminate\Http\RedirectResponse
    {
        $newOrder = $oneClickOrders->fill($request->all());
        $saved = $newOrder->save();

        event(new OrderBuyClickEvent($newOrder));

        $product = Product::findOrFail($request->product_id);

        session()->put('one_click_order',  [
            'transaction' => $newOrder->unique_id,
            'price' => $product->format_price,
            'sku' => $product->sku,
            'name' => $product->name,
            'category' => $product->getMainCategoryAttribute()->name
        ]);

        return $saved
            ? $this->redirect('success', __('frontend.order_created_per_click'))
            : $this->redirect('error', __('frontend.error_title'));
    }
}
