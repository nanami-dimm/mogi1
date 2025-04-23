<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PurchaseCompletedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $exhibition;
    public $buyer;

    public function __construct($exhibition, $buyer)
    {
        $this->exhibition = $exhibition;
        $this->buyer = $buyer;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {   
        //dd($this->exhibition, $this->buyer);
        return $this->subject('商品が購入されました')->view('emails.purchase-completed');
    }
}
