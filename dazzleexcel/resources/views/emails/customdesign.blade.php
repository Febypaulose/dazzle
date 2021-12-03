@component('mail::message')





Hi <b> {{$email_data['name']}}</b>,





The total amount you have to pay for your customized dress is {{$email_data['amount'].' '. 'USD'}}

<br />
Kindly click below to pay the amount<br />





@component('mail::button', ['url' => $email_data['link']])





Pay Now <br/>





@endcomponent





Regards,<br />


Dazzleknots.














@endcomponent