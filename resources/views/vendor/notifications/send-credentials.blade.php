<x-mail::message>
{{-- Greeting --}}
# Hello {{ $user->name }},

You are registered by admin. Please find the below credentials for login.

Email: {{ $user->email }}

Password: {{ $password }}

Click on below button to login.
<x-mail::button :url="route('login')">Login</x-mail::button>

{{-- Salutation --}}
@if (! empty($salutation))
{{ $salutation }}
@else
@lang('Regards'),<br>
{{ config('app.name') }}
@endif

<x-slot:subcopy>
@lang(
    "If you're having trouble clicking the Login button, copy and paste the URL below\n".
    'into your web browser:',
    [
        'actionText' => 'Login URL',
    ]
) <span class="break-all">[{{ route('login') }}]({{ route('login') }})</span>
</x-slot:subcopy>
</x-mail::message>
