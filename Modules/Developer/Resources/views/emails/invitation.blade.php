@component('mail::message')
# Account Activation

Hi {{$invitation->invited_to_name}},

You have been invited to join {{ config('app.name') }} platform by {{$sender->name}}.
Please click on this link to complete your registration.

@component('mail::button', ['url' => App::make('url')->to('/')])
    Confirm & Activate Account
@endcomponent

Thanks,<br>
{{ config('app.name') }} Team
@endcomponent