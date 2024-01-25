<?php

namespace App\Notifications;

use DateTime;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;

class RepliedToThread extends Notification
{
    use Queueable;

    protected $userChat;

    public $thread;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($userChat)
    {
         $this->thread=$userChat;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database','broadcast'];
    }



    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return[
            'thread'=>$this->thread,
            'user'=>auth()->user()
        ];
    }


    public function toBroadcast($notifiable)
    {
        $mytime = Carbon::now();
        $nowTime = $mytime->toDateTimeString();
        return new BroadcastMessage([
            'thread'=>$this->thread,
            'user'=>auth()->user(),
            'updated_at'=> $nowTime
        ]);
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
