@component('mail::message')
<p>Dear {{$data['client_name']}}</p>
<p>Officespacecrm Support team is answered the your ticket. if you get any doubt about it, please contact us on over the phone.</p>

<p>{{$data['ticket_number']}}</p>
<p>{{$data['title']}}</p>
<p>{{$data['description']}}</p>

Answer:
<p>{{$data['reply']}}</p>

Best Regards <br>
Total Business Centre
@endcomponent
