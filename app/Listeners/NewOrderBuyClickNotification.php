<?php

namespace App\Listeners;

use App\Events\OrderBuyClickEvent;
use App\Helpers\ShopHelper;
use App\Notifications\NewOrderBuyClickAdminEmail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;

class NewOrderBuyClickNotification
{
    /**
     * Handle the event.
     *
     * @param \App\Events\OrderBuyClickEvent $event
     *
     * @return void
     */
    public function handle(OrderBuyClickEvent $event): void
    {
        $admins = ShopHelper::feedback_emails();
        if (count($admins)) {

            foreach ($admins as $admin) {
                if ($admin) {

//                    dd(Notification::send($admin, new NewOrderBuyClickAdminEmail($event->clickOrders)));
                    Notification::send($admin, new NewOrderBuyClickAdminEmail($event->clickOrders));
                }
            }
        }
    }
}
