<?php

namespace App\Mail;

use App\Models\Restaurant;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CustomerMail extends Mailable
{
    use Queueable, SerializesModels;

    private $order;
    private $restaurant_id;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order, $restaurant_id)
    {
        $this->order = $order;
        $this->restaurant_id = $restaurant_id;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $new_order = $this->order;
        $restaurant = Restaurant::where('id', $this->restaurant_id)->get();

        return $this->view('mails.orders.customer_order', compact('new_order', 'restaurant'));
    }
}
