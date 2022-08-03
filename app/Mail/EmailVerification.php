<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailVerification extends Mailable
{
    use Queueable, SerializesModels;

    protected $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // dd($this->user);
        $url = URL::to('/').'/verify/'.$this->user->password;
        // $url = URL::to('/').'/verify/'.Crypt::encryptString($this->user->name.$this->user->email);

        return $this->view('mail.email-verification')
                        ->with([
                            'user' => $this->user,
                            'url' => $url,
                        ]);
    }
}
