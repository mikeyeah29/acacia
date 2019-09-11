<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderCreated extends Mailable
{
    use Queueable, SerializesModels;

    var $orderid;
    var $toEmail;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($orderid, $toEmail)
    {
        $this->orderid = $orderid;  
        $this->toEmail = $toEmail; 
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.order-created');
    }
}
