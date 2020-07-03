<?php

namespace App\Notifications;

use App\Product;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewProductCreatedNotification extends Notification implements ShouldQueue
{
   use Queueable;

   protected $product;
   protected $user;
   /**
    * Create a new notification instance.
    *
    * @return void
    */
   public function __construct(Product $product, User $user)
   {
      $this->product = $product;
      $this->user = $user;
   }

   /**
    * Get the notification's delivery channels.
    *
    * @param  mixed  $notifiable
    * @return array
    */
   public function via($notifiable)
   {
      return ['mail'];
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
         ->line("Dear {$this->user->name},")
         ->line("A new product '{$this->product->name}' was created")
         ->action('Visit site', url('/'))
         ->line('Thank you for using Foodbyus');
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
