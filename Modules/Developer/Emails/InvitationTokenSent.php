<?php

namespace Modules\Developer\Emails;

use App\Entities\Invitation;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class InvitationTokenSent extends Mailable
{
    use Queueable, SerializesModels;

    protected $invitation;
    protected $token;
    protected $sender;

    /**
     * InvitationTokenSent constructor.
     * @param Invitation $invitation
     * @param $token
     * @param $sender
     */
    public function __construct(Invitation $invitation, $token, $sender)
    {
        $this->invitation = $invitation;
        $this->token = $token;
        $this->sender = $sender;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('developer::emails.invitation-token')
            ->with([
                'invitation' => $this->invitation,
                'token' => $this->token,
                'sender' => $this->sender
            ])
            ->subject('Account Activation');
    }
}
