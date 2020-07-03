<?php

namespace App\Listeners;

use App\Events\ProductCreated;
use App\Notifications\NewProductCreatedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;
use App\User;

class SendProductCretedNotification
{
   /**
    * Create the event listener.
    *
    * @return void
    */
   public function __construct()
   {
      //
   }

   /**
    * Handle the event.
    *
    * @param  ProductCreated  $event
    * @return void
    */
   public function handle(ProductCreated $event)
   {
      $when = now()->addMinutes(1);
      
      foreach (User::all() as $user) {
         $user->notify((new NewProductCreatedNotification($event->product, $user))->delay($when));
      }
   }
}
