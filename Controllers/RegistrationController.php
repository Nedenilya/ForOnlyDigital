<?php 

require_once "../User.php";

if(isset($_POST['name']) && isset($_POST['phone']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['passwordC'])){
	if($_POST['password'] !== $_POST['passwordC'])
		die("Password mismatch");
	$user = new User(
		$_POST['name'],
		$_POST['phone'],
		$_POST['email'],
		$_POST['password']
	);

	if($user->register()){
		setcookie('USER_ID', $user->Id, time() + 259200, '/');
		setcookie('USER_PHONE', $user->Phone, time() + 259200, '/');
		setcookie('USER_EMAIL', $user->Email, time() + 259200, '/');
		setcookie('USER_NAME', $user->Name, time() + 259200, '/');
	}	
}
?>