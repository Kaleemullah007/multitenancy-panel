@component('mail::message')
    # Thanks For Reaching out to us

    {{ $reply->message }}

@component('mail::button', ['url' => env('APP_URL')])
        Feel Free to Contact
@endcomponent
    Thanks, </br>
    {{ config('app.name') }}
@endcomponent
