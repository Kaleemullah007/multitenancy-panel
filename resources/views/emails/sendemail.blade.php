<x-mail::message>
    # Thanks For Reaching out to us

    {{ $reply->message }}

    @component('mail::button', ['url' => 'https://rkfoodtrading.com'])
        Feel Free to Contact
    @endcomponent

    Thanks,<br>
    {{ config('app.name') }}
</x-mail::message>
