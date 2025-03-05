{{-- <p>Hello {{ $user->name }},</p>
<p>Click the link below to verify your account:</p>
<a href="{{ $verificationUrl }}">Verify My Account</a> --}}


Hello {{$user->name}},</b>
 
<p> A new user has been created for you, please <a href="{{$verificationUrl}}">click here</a> to establish a password and confirm your access.</p>

<p>  Once you have set a password, please log in using the following e-mail address: {{$user->email}}.</p>