@component('mail::message')


@php











@endphp


Hi <b> Admin</b>,





you received an inquiry from DazleKnots 


<br />








<p>Name : {{ $email_data['name'] }} </p><br/>


<p>Mobile : {{ $email_data['mobile'] }} </p><br/>


<p>Email : {{ $email_data['mail'] }} </p><br/>


<p>Message : {{ $email_data['message'] }} </p><br/>








 <br/>











Regards,<br />


DazleKnots.





@endcomponent