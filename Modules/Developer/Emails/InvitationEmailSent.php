<?php

namespace Modules\Developer\Emails;

use App\Entities\Invitation;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class InvitationEmailSent extends Mailable
{
    use Queueable, SerializesModels;

    protected $invitation;

    protected $sender;

    public function __construct(Invitation $invitation, $sender)
    {
        $this->invitation = $invitation;
        $this->sender = $sender;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('developer::emails.invitation')
            ->with([
                'invitation' => $this->invitation,
                'sender' => $this->sender
            ])
            ->subject('Account Activation');
    }
}
