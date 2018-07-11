<?php

namespace App\Observers;

use App\Entities\Invitation;

class InvitationObserver
{
    public function creating(Invitation $invitation)
    {
        $invitation->email_token = md5(uniqid(rand(), true));
    }
}
