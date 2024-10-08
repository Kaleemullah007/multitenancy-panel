<x-mail::message>
# Introduction

Hi {{$user->name}}
Your account has been renewed till {{$user->end_date}}

<x-mail::button :url="''">
More information
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
