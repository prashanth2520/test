<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

class shareRecords extends Mailable
{
    use Queueable, SerializesModels;
    public $filename;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($filename)
    {
        $this->filename = $filename;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        $this->view('emails.recordsShare');
        foreach($this->filename as $file) 
            $this->attach($file);
            
        return $this;
    }
}
