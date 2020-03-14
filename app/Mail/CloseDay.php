<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CloseDay extends Mailable
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
        // return $this->view('view.name');
        return $this->from('mnyemba05@gmail.com', 'Nyembaz Hardware Report')
        ->subject(date("d F Y").' Report')
        ->markdown('mails.products')
        ->with([
            'name' => 'Admin',
            'link' => 'http://localhost/inventory_laravel/inventory_laravel/public/export'
        ]);
    }
}
