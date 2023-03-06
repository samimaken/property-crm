@component('mail::message')
<p>Thanks for reaching out to Total Business Centre!</p>

<p>You’re in good hands, and we’re doing our best to get back to you within 12 hours, if not sooner. We appreciate your patience, and apologize in advance if it takes a little longer.</p>

<p>Your ticket: {{$data['ticket_number']}}</p>

Best Regards <br>
Total Business Centre

@endcomponent
