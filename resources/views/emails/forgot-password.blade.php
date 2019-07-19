
    @include('emails.user-header')
        <h1 style="text-align: center; color: #404040; margin-bottom: 30px; font-size: 30px; font-weight: bold;">Forgot your password</h1>
        <p style="font-size: 16px; color: #404040; line-height:22px;">Dear {{$name}}</p>
        <p style="font-size: 16px; color: #404040; line-height:22px;">Please click below link to reset your password.</p>
        <p style="font-size: 16px; color: #404040; line-height:22px;">
            <a href="{{$link}}" style=" background: #23CF5F; padding: 15px 35px; text-decoration: none;">
                Reset Password
            </a>
        </p>
        <p style="font-size: 16px; color: #404040; line-height:22px;">If you didn't request to change, simply delete this email.</p>
    @include('emails.user-footer')
