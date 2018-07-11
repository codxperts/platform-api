<?php

namespace Modules\Developer\Events;

use App\Entities\Invitation;
use Illuminate\Queue\SerializesModels;

class InviteFriend
{
    use SerializesModels;

    public $invitation;

    public $token;

    public $sender;

    /**
     * InviteFriend constructor.
     * @param Invitation $invitation
     * @param $activation_token
     */
    public function __construct(Invitation $invitation, $activation_token)
    {
        $this->invitation = $invitation;

        $this->token = $activation_token;

        $this->sender = auth()->user();
    }

}
