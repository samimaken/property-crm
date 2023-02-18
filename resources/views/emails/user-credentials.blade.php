@component('mail::message')

Welcom {{$data['name']}}

Your Login Credentials

<p><strong>Email</strong>: {{$data['email']}} </p>
<p><strong>Password</strong>: {{$data['password']}}</p>

@component('mail::button', ['url' => url('/admin')])
Login
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
