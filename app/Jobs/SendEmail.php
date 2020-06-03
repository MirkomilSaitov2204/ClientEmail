<?php

namespace App\Jobs;

use App\Mail\EmailSender;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Symfony\Component\HttpFoundation\Request;

class SendEmail  implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

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
     * Execute the job.
     *
     * @return void
     */
    public function handle(Request $request)
    {
        $email = new EmailSender($this->user, $this->name, $this->description);

        Mail::to($this->user)->send($email);

    }
}
