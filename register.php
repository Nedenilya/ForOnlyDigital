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
      <div class="register-form">
        <input class="name" type="text" placeholder="Name"/>
        <input class="phone" type="text" placeholder="Phone number"/>
        <input class="email" type="text" placeholder="E-mail"/>
        <input class="password" type="password" placeholder="Password"/>
        <input class="passwordC" type="password" placeholder="Confirm Password"/>
        <button class="register-button">Register</button>
        <p class="message">Already registered? <a href="index.php">Sign In</a></p>
      </div>
    </div>
  </div>

</body>
<script type="text/javascript" src="assets/jquery.min.js"></script>
<script type="text/javascript" src="assets/script.js"></script>
</html>