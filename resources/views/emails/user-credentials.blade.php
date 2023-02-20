@component('mail::message')

Welcome to officespacecrm.ae {{$data['name']}}

User Login Details - officespacecrm.ae

<p><strong>Email</strong>: {{$data['email']}} </p>
<p><strong>Password</strong>: {{$data['password']}}</p>

@component('mail::button', ['url' => url('/admin')])
Login
@endcomponent

Thanks,<br>
officespacecrm team.
@endcomponent
