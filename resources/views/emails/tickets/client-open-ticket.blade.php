@component('mail::message')
<p>{{$data['client_name']}} is open the ticket {{$data['ticket_number']}} in here. please review it and update it.</p>

@component('mail::button', ['url' => route('tickets.show', ['ticket' => $data['id']])])
View Ticket
@endcomponent

Thanks

*This e-mail was system generated.
@endcomponent
