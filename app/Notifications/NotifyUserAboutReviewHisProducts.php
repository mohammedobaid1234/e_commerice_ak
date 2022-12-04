<?php

namespace App\Notifications;

use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NotifyUserAboutReviewHisProducts extends Notification
{
    use Queueable;
    public $product;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Product $product){
        return $this->product = $product;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable){
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    public function toDataBase($notifiable){
        return [
            'en' => [
                'title' => __('A :product_name', ['product_name' => $this->product->name]),
                'body' => __('A :product_name is under review' , [
                    'product_name' => $this->product->name
                ]),
            ],
            'ar' => [
                'title' => __(' :product_name', ['product_name' => $this->product->name]),
                'body' => __(':product_name قيد المراجعة' , [
                    'product_name' => $this->product->name
                ]),
            ],
        ];
    }
    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
