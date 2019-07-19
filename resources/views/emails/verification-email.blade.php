@include('emails.user-header')
<h1 style="text-align: center; color: #404040; margin-bottom: 30px; font-size: 30px; font-weight: bold;">Account verification</h1>
    <p style="font-size: 16px; color: #404040; line-height:22px;">You have successfully created a Libido account. Please press on the link below to verify your email address and complete your registration.</p>
    <p style="font-size: 16px; color: #404040; line-height:22px;">
        <a href="{{$data['url']}}" style=" background: #23CF5F; padding: 15px 35px; text-decoration: none;">
            Verify Your Email
        </a>
    </p>
@include('emails.user-footer')