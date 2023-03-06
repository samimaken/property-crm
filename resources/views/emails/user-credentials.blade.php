@component('mail::message')

Welcome to Total Business Centre {{$data['name']}}

User Login Details - Total Business Centre

<p><strong>Email</strong>: {{$data['email']}} </p>
<p><strong>Password</strong>: {{$data['password']}}</p>

@component('mail::button', ['url' => url('/admin')])
Login
@endcomponent

Thanks,<br>
Total Business Centre
@endcomponent
