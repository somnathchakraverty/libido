
var userService = {};
userService.addToSubscriptionNewsLetter = function (args) {
   $('.loading-overpay').show();
    $.ajax({
        type: 'POST',
        url: 'web/subscribe-newsletter',

        headers: {
             'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        },
        data: {email: args.email},
        success: function (response) {
            $('.loading-overpay').hide();
            $('#subscription_email').removeClass('loadinggif');
            $('#success-msg').text(response.message);
            $('#subscription_email').val('');
            args.cb(response);
        },
        beforeSend: function () {
            $('#subscription_email').addClass('loadinggif');
        },
        error: function (response) {
            $('.loading-overpay').hide();
            $('#failure-msg').text(response.message);
            $('#subscription_email').removeClass('loadinggif');
            args.cb(response);
        }
        
    });
};

userService.addToSubscriptionNewsLetterIn = function (args) {
   $('.loading-overpay').show();
    $.ajax({
        type: 'POST',
        url: 'web/subscribe-newsletter',

        headers: {
             'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        },
        data: {email: args.email},
        success: function (response) {
            $('.loading-overpay').hide();
            $('#subscription_email').removeClass('loadinggif');
            $('#success-msg-in').text(response.message);
            $('#subscription_email-in').val('');
            args.cb(response);
        },
        beforeSend: function () {
            $('#subscription_email').addClass('loadinggif');
        },
        error: function (response) {
            $('.loading-overpay').hide();
            $('#failure-msg-in').text(response.message);
            $('#subscription_email').removeClass('loadinggif');
            args.cb(response);
        }
        
    });
};

$(document).ready(function () {
    
    $( "#sign-up-for-newsletter" ).click(function() {
        
      var email = $('#subscription_email').val();
      var result = userService.addToSubscriptionNewsLetter({
        email:email,
            cb: function (res) {
                    if (res.status == true) {
                        window.location.reload();

                    } else {
                        if (res.status === 500)
                        {
                            var response = JSON.parse(res.responseText);
                            alert(response.message);
                        } else {
                            var response = JSON.parse(res.responseText);
                            alert(response.message);
                        }
                    }


                }
        });
    });
    
    $( "#sign-up-for-newsletter-in" ).click(function() {
        
      var email = $('#subscription_email_in').val();
      var result = userService.addToSubscriptionNewsLetterIn({
        email:email,
            cb: function (res) {
                    if (res.status == true) {
                        window.location.reload();

                    } else {
                        if (res.status === 500)
                        {
                            var response = JSON.parse(res.responseText);
                            alert(response.message);
                        } else {
                            var response = JSON.parse(res.responseText);
                            alert(response.message);
                        }
                    }


                }
        });
    });
    
});