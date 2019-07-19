<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Libido</title>
        <!--build:css css/app.min.css -->
        <link href="{{ asset('fonts/stylesheet.css')}} rel="stylesheet">
              <!-- Bootstrap -->
              <link href="{{ asset('css/bootstrap.min.css')}}" rel="stylesheet">
        <link href="{{ asset('plugins/parsley/css/parsley.css')}}" rel="stylesheet">
        <!-- endbuild -->


        <link href="{{asset('css/resetpassword.css')}}" rel="stylesheet">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
                <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
                <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
            <![endif]-->
    </head>

    <body class="bg-reset" background="{{asset('images/background-06.jpg')}}">

        <div class="content-wrapper-setting">
            <div style="text-align:center;"><img src="{{asset('images/icon.png')}}" class="logo"
                   "></div>
            <h1 style="
                text-align:  center;
                ">Libido</h1>
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <div class="col-md-12">
                <div id="error-msg" class="error-box hidden"></div>
            </div>
            <form id="resetpswdForm" class="change-password-form" action="{{ url('user/reset-password')}}" method="post" autocomplete="off" data-parsley-validate>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="verifyToken" value="{{$token}}"
                       <div class="content-wrapper-setting-change-password">

                    <div class="form-group">
                        <label for="newPassword">New Password</label>
                        <input type="password" class="form-control" name="password" id="newPassword" placeholder="Enter New Password" data-parsley-length="[6,14]" data-parsley-trigger="change"  data-parsley-required-message="Please enter a new password" data-parsley-length-message="Passwords must be between 6 to 14 characters" data-parsley-errors-container="#error-msg" required>
                    </div>
                    <div class="form-group">
                        <label for="confirmPassword">Confirm New Password</label>
                        <input type="password" class="form-control" name="passwordConfirmation" id="confirmPassword" placeholder="Confirm New Password"  data-parsley-length="[6,14]" data-parsley-trigger="change" data-parsley-equalto="#newPassword"  data-parsley-equalto-message="The password you entered do not match" data-parsley-required-message="Please confirm your new password" data-parsley-length-message="Passwords must be between 6 to 14 characters"  data-parsley-errors-container="#error-msg" required>
                    </div>
                </div>
                <div class="text-center reset-btn-box">

                    <button type="submit" class="next-step" >Submit</button>
                </div>
            </form>
        </div>
    </div>




        <!--build:js js/app.min.js -->
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="js/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="js/bootstrap.bundle.min.js"></script>
        <script src="plugins/parsley/js/parsley.min.js"></script>
        <!-- endbuild -->
        <script>
$('#resetpswdForm').parsley().on('field:validated', function () {
    var ok = $('.parsley-error').length === 0;
    $('.bs-callout-info').toggleClass('hidden', !ok);
    $('.error-box').toggleClass('hidden', ok);
})
        .on('form:submit', function () {

            return true;
        });
        </script>
    </body>

</html>