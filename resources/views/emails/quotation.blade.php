@component('mail::message')
Dear {{$data['client_name']}},

<p>We hope this email finds you well. I am writing to provide you with a quotation for requested unit/units. As discussed earlier, the quotation includes all the necessary details such as the unit description, pricing, and other information.</p>

<p>To make it easy for you to review the quotation, I have included a "View Quotation" button below. </p>

<p>Simply click on the button, and you will be directed to a webpage where you can view the quotation in a clear and concise format.</p>

@component('mail::button', ['url' => route('web.quotation',['number' => $data['number'], 'token' => $data['token']])])
View Quotation Button
@endcomponent

<p>Please note that this quotation is valid for {{$data['days']}} Days. You can Accept or Reject the quotation by click the button it.  If you have any questions or would like to discuss this further, please do not hesitate to us.</p>

<p>Thank you for considering our services. We look forward to working with you.</p>

Best regards,<br>
Officespacecrm team

@endcomponent
