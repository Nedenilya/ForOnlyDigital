$('.register-button').on('click', function(){

	var formData = new FormData();
    formData.append("name", $('.name').val());
    formData.append("email", $('.email').val());
    formData.append("phone", $('.phone').val());
    formData.append("password", $('.password').val());
    formData.append("passwordC", $('.passwordC').val());

    $.ajax({
        url: "Controllers/RegistrationController.php",
        type: 'POST',
        cache: false,
        contentType: false,
        processData: false,
        data: formData,
        success: function (response) {
            if(response)
                alert(response);
            else
                window.location = "/profile.php";
        }
    });

});

$('.login-button').on('click', function(){
    var captcha = grecaptcha.getResponse();

    if (!captcha.length) {
      $('#recaptchaError').text('You didn\'t pass the "I\'m not a robot" test');
    } else {
      $('#recaptchaError').text('');
    }

    if (captcha.length) {

        var formData = new FormData();
        formData.append('g-recaptcha-response', captcha);
        formData.append("phone-or-email", $('.phone-or-email').val());
        formData.append("password", $('.password').val());

        $.ajax({
            url: "Controllers/AuthController.php",
            type: 'POST',
            cache: false,
            contentType: false,
            processData: false,
            data: formData,
            success: function (response) {
                if(response)
                    alert(response);
                else
                    window.location = "/profile.php";
            }
        });
    }

    grecaptcha.reset();
    
});


$('.data-input').on('focus', function() {
    $('.update-button').removeClass('hide');
});

$('.update-button').on('click', function(){
    var formData = new FormData();
    formData.append("name", $('.data-name').val());
    formData.append("password", $('.data-pssword').val());
    formData.append("phone", $('.data-phone').val());
    formData.append("email", $('.data-email').val());
    formData.append("id", $('.data-id').val());

    $.ajax({
        url: "Controllers/UpdateController.php",
        type: 'POST',
        cache: false,
        contentType: false,
        processData: false,
        data: formData,
        success: function (response) {
            if(response)
                alert(response);
            else
                window.location = "/profile.php";
        }
    });
    $('.update-button').addClass('hide');
});

$('.logout-button').on('click', function(){
    var formData = new FormData();
    formData.append('action', 'logout');
    //formData.append("id", $('.data-id').val());

    $.ajax({
        url: "Controllers/AuthController.php",
        type: 'POST',
        cache: false,
        contentType: false,
        processData: false,
        data: formData,
        success: function (response) {
            window.location = "/index.php";
        }
    });
});