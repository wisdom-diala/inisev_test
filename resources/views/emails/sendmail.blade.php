@component('mail::message')
# New Post

## Title:
{{ $title }}

## Description:
{{ $description }}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
