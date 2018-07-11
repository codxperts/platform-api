@component('mail::message')
# Account Activation

Hi {{$sender->name}},

You have been invited <b>{{$invitation->invited_to_name}}</b> to join out platform.
Following is the code that he/she needs to activate his/her account.

@component('mail::panel')
    <h1>{{$token}}</h1>
@endcomponent

Thanks,<br>
{{ config('app.name') }} Team
@endcomponent