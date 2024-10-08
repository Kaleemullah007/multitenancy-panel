<x-mail::message>
# Introduction

Hi {{$user->name}}
Your account   {{ $day !=0 ?'will be expired after '.$day:'has been expired' }}


Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
