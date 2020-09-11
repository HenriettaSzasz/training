<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $pdf;

    public $order;

    /**
     * Create a new message instance.
     *
     * @param $pdf
     * @param $order
     */
    public function __construct($pdf, $order)
    {
        $this->pdf = $pdf;
        $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('customer\pdf')->attachData($this->pdf->output(), 'order.pdf', [
                'mime' => 'application/pdf',
            ]);
    }
}
