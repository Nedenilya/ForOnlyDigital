<?php 
if(isset($_COOKIE['USER_ID']))
  header('Location: profile.php');
?>
<!DOCTYPE html>
<html>
<head>
  <title>Test</title>
  <link rel="stylesheet" type="text/css" href="assets/style.css">
</head>
<body>

  <div class="login-page">
    <div class="form">
      <div class="login-form">
        <input type="text" class="phone-or-email" placeholder="Phone Or E-mail"/>
        <input type="password" class="password" placeholder="Password"/>
        <button class="login-button">login</button>
        <div class="capcha-box">
          <div class="g-recaptcha" data-sitekey="6Ld4fv4mAAAAAJOSj5czhMY6PLfndkhNEgGS7pWs"></div>
          <div class="text-danger" id="recaptchaError"></div>
        </div>
        <!-- public: 6LdGYf4mAAAAALm7q4W9Ktw51dVU9RUJoSQMJTOu -->
        <!-- secret: 6LdGYf4mAAAAAM-mGf6bZLDzeIrBInYn0MGZl-OG -->
        <p class="message">Not registered? <a href="register.php">Create an account</a></p>
      </div>
    </div>
  </div>

</body>
<!-- js-скрипт гугл капчи -->
<script src='https://www.google.com/recaptcha/api.js'></script>
<script type="text/javascript" src="assets/jquery.min.js"></script>
<script type="text/javascript" src="assets/script.js"></script>
</html>