<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailPemberitahuan extends Mailable
{
    use Queueable, SerializesModels;
    public $data; // Menambahkan variabel data

    public function __construct($data)
    {
        $this->data = $data; // Menginisialisasi variabel data
    }


    public function build()
    {
        return $this->from('iktnlearning@gmail.com', 'IKTN Learning Notification')
            ->subject('IKTN Learning Notification')
            ->view('emails.pemberitahuan')
            ->with('data', $this->data);
    }
}
