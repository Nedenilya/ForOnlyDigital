<?php 

require_once "../User.php";
require_once ('../recaptcha/autoload.php');

if(isset($_POST['action']) && $_POST['action'] == 'logout'){
	setcookie('USER_ID', '', time()-3600, '/');
	setcookie('USER_PHONE', '', time()-3600, '/');
	setcookie('USER_EMAIL', '', time()-3600, '/');
	setcookie('USER_NAME', '', time()-3600, '/');
	return;
}


$secret = '6Ld4fv4mAAAAAJkdSjSqYrB7Ygve1-p8RHLBhcgl';


if (isset($_POST['g-recaptcha-response'])) {
  	$recaptcha = new \ReCaptcha\ReCaptcha($secret);
  	$resp = $recaptcha->verify($_POST['g-recaptcha-response'], $_SERVER['REMOTE_ADDR']);

	if ($resp->isSuccess()){

	    if(isset($_POST['phone-or-email']) && isset($_POST['password'])){
			$user = new User();
			if($user->login($_POST)){
				setcookie('USER_ID', $user->Id, time() + 259200, '/');
				setcookie('USER_PHONE', $user->Phone, time() + 259200, '/');
				setcookie('USER_EMAIL', $user->Email, time() + 259200, '/');
				setcookie('USER_NAME', $user->Name, time() + 259200, '/');
			}else{
				die("Wrong data. Please check the entered data");
			}
		}else{
			die("Something went wrong, please try again");
		}

	} else {
	    $errors = $resp->getErrorCodes();
	    die('The captcha code was not validated on the server');
	}

}else{
  	die("Unknown error");
}






?>