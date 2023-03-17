<?php

namespace App\Notifications;

use App\Enums\ServiceType;
use App\Models\Document\DocumentRequest;
use App\Models\Order\ServiceOrder;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

/**
 * Class NewClientCallbackEmail
 *
 * @package App\Notifications
 */
class NewClientCallbackEmail extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * @var User
     */
    private $user;

    /**
     * @var ServiceOrder
     */
    private $serviceOrder;

    /**
     * NewPayerEmail constructor.
     *
     * @param  User         $user
     * @param  ServiceOrder $serviceOrder
     */
    public function __construct(User $user, ServiceOrder $serviceOrder)
    {
        $this->user         = $user;
        $this->serviceOrder = $serviceOrder;
        $this->queue        = config('queue.mail_queue_name');
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed $notifiable
     *
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed $notifiable
     *
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $user         = $this->user;
        $serviceOrder = $this->serviceOrder;
        $message      = (new MailMessage)
            ->view('frontend.mails.client_request.index', compact('user', 'serviceOrder'))
	        ->subject($this->serviceOrder->type->getDesc());
        if ($serviceOrder->file) {
            $message->attach($serviceOrder->getAttachment());
        }
        return $message;

    }
}
