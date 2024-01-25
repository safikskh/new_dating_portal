<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class newMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Datingportalen')
            ->markdown('email')
            ->attach('/img/logo.png');

        // $email = $this->view('emails.employment_mailview')->subject('Employment Application');
        // // $attachments is an array with file paths of attachments
        // foreach($attachments as $filePath){
        //     $email->attach($filePath);
        // }
        // return $email;
    }
}
