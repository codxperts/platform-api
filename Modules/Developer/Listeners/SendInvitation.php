<?php

namespace Modules\Developer\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;
use Modules\Developer\Emails\InvitationEmailSent;
use Modules\Developer\Emails\InvitationTokenSent;
use Modules\Developer\Events\InviteFriend;

class SendInvitation
{


    public function handle(InviteFriend $event)
    {

        Mail::to([$event->invitation->invited_to_email])
            ->queue(new InvitationEmailSent($event->invitation, $event->sender));

        Mail::to([$event->sender->email])
            ->queue(new InvitationTokenSent($event->invitation, $event->token, $event->sender));
    }
}
