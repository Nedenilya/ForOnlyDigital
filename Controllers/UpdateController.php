<?php 

require_once "../User.php";

if(isset($_POST['name']) && isset($_POST['phone']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['id'])){
	$user = new User();
	if($user->update($_POST)){
		setcookie('USER_PHONE', $user->Phone, time() + 259200, '/');
		setcookie('USER_EMAIL', $user->Email, time() + 259200, '/');
		setcookie('USER_NAME', $user->Name, time() + 259200, '/');
		echo "User data updated";
	}
	else{
		echo "User data not updated";
	}
}else{
	die('Not all data entered');
}

?>