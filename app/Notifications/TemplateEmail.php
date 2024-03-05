<?php

namespace App\Notifications;

use App\User;
use App\Models\Portal;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Notifications\Messages\MailMessage;

class TemplateEmail extends Notification 
{
    use Queueable;

    protected $notification;

    public $thread;
    public $user;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($notification)
    {
        $this->thread=$notification;
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
        if ($this->thread->notificationType == 1) { //inbox notification
            return (new MailMessage)
                        ->subject('Ny besked modtaget på din profil')
                        ->line(auth()->user()->portalInfo->userName.' har sendt dig en besked.')                        
                        ->action('Gå til indbakke', url('/chat?id='. auth()->id()))
                        ->line('Vi håber du er glad for vores side og modtager gerne både ris og ros på hello@datingportalen.com.');
        }elseif ($this->thread->notificationType == 2) { // fav inbox notification
            return (new MailMessage)
                        ->subject('Ny besked modtaget på din profil')
                        ->line(auth()->user()->portalInfo->userName.' har sendt dig en besked.')
                        ->action('Gå til indbakke', url('/favchat?id='. auth()->id()))
                        ->line('Vi håber du er glad for vores side og modtager gerne både ris og ros på hello@datingportalen.com.');
        }
        elseif ($this->thread->notificationType == 3) { // others notification
            return (new MailMessage)
                        ->line(auth()->user()->userName.' has sent a message.')
                        ->action('Go inbox', url('/favchat?id='. auth()->id()))
                        ->line('Thank you for using our application!');
        }
        elseif ($this->thread->notificationType == 4) { // user report
            $email = new MailMessage();
            $email->line(auth()->user()->email . ' reported against ' . User::find($this->thread->to_user_id)->email)
            ->line($this->thread->details)
            ->action('Go reported profile', url('/profile?user_id='. $this->thread->to_user_id))
            ->subject('Report | ' . $this->thread->title);

            foreach(json_decode($this->thread->files, true) as $filePath){
                $email->attach( $filePath);
            }
                
            return  $email;
        }
        elseif ($this->thread->notificationType == 5) { //new portal registration 
            $email = new MailMessage();
            $email->line('Tak for at tilmelde dig ' . Portal::find($this->thread->portal_id)->portalType) 
            ->action('Login', url('/'))
            ->subject('Velkommen til ' . Portal::find($this->thread->portal_id)->portalType) 
            ->line('Vi håber du er glad for vores side og modtager gerne både ris og ros på hello@datingportalen.com.');           
            return  $email;
        }
        elseif ($this->thread->notificationType == 6) { //newly  registration
            $email = new MailMessage();
            $email->line('Din registrering og dit abonnement er tilføjet')
            ->subject('Velkommen til ' . Portal::find($this->thread->portal_id)->portalType)
            ->line('Vi håber du er glad for vores side og modtager gerne både ris og ros på hello@datingportalen.com.');            
            return  $email;
        }
        elseif ($this->thread->notificationType == 7) { //newly  registration with facebook
            $email = new MailMessage();
            $email->line('Din registrering og dit abonnement er tilføjet')
            // ->line('Email: '.$this->thread->email)
            // ->line('Password: '. '123456')
            ->action('Login', url('/'))
            ->subject('Velkommen til ' . Portal::find($this->thread->portal_id)->portalType)
            ->line('Vi håber du er glad for vores side og modtager gerne både ris og ros på hello@datingportalen.com.');            
            return  $email;
        }
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
