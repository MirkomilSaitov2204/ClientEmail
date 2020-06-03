<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailSender extends Mailable
{
    use Queueable, SerializesModels;

    protected $user;
    protected $name;
    protected $description;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($user, $name, $description)
    {
        $this->user = $user;
        $this->name = $name;
        $this->description = $description;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this->view('email.email')->with([
            'name' =>  $this->name,
            'description' => $this->description
        ]);
    }
}
