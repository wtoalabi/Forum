@component('mail::message')
# Hey Champ!

You need to confirm you email address before continuing.
Thanks for the understanding.

@component('mail::button', ['url' => url("api/confirm-token/confirm?token=$user->confirmation_token")])
Click to confirm.
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
