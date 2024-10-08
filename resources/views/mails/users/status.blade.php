<x-mail::message>
# Introduction

Hi {{$user->name}}
You are account has been expired  {{ $day !=0 ?'after '.$day:'' }}


Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
