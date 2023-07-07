<?php 
require_once 'User.php';

if(isset($_COOKIE['USER_ID'])){
	$user = new User();
	$user->loginById($_COOKIE['USER_ID']);
}
else{
	header('Location: index.php');
}

?>

<!DOCTYPE html>
<html>
<head>
  <title>Profile | <?=$_COOKIE["USER_NAME"];?></title>
  <link rel="stylesheet" type="text/css" href="assets/style.css">
</head>
<body>

  <div class="profile">
    <div class="profile-board">
      <div class="data-box">
      	<table>
	      	<tr>
			    <td><div class="data-string">Name: </div></td>
			    <td><input class="data-input data-name" type="text" value="<?=$user->Name;?>" /></td>
		    </tr>
		    <tr>
		    	<td><div class="data-string">Phone: </div></td>
				<td><input class="data-input data-phone" type="text" value="<?=$user->Phone;?>" />	</td>
		    </tr>
		    <tr>
		    	<td><div class="data-string">Email: </div></td>
				<td><input class="data-input data-email" type="text" value="<?=$user->Email;?>" />  </td>  	
		    </tr>
		    <tr>
		    	<td><div class="data-string">Password: </div></td>
				<td><input class="data-input data-pssword" type="text" value="<?=$user->getPassword();?>" /></td>
		    </tr>
	    </table>
	    <input class="data-input data-id" type="hidden" value="<?=$user->Id;?>" />
	    <button class="update-button hide">Update</button>
	    <button class="logout-button">Logout</button>
      </div>
    </div>
  </div>

</body>
<script type="text/javascript" src="assets/jquery.min.js"></script>
<script type="text/javascript" src="assets/script.js"></script>
</html>