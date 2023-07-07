<?php

class DBController
{

	private $connection;
	
	function connect(){
		$this->connection = new mysqli("localhost", "root", "", "only_digital_users");
		if($this->connection->connect_error)
		    die("Error: Something went wrong, please try again later"); //For users
			//die("Error: " . $this->connection->connect_error);        //For debug
	}

	function checkingForRegistration(User $user, $cookie = false){
		if($cookie){
			if($user->Name != $_COOKIE['USER_NAME']){
				$result = mysqli_query($this->connection, "SELECT * FROM users WHERE name = '" . $user->Name . "'");
				if($row = mysqli_fetch_array($result))
					return true;
			}
			if($user->Phone != $_COOKIE['USER_PHONE']){
				$result = mysqli_query($this->connection, "SELECT * FROM users WHERE phone = '" . $user->Phone . "'");
				if($row = mysqli_fetch_array($result))
					return true;
			}
			if($user->Email != $_COOKIE['USER_EMAIL']){
				$result = mysqli_query($this->connection, "SELECT * FROM users WHERE email = '" . $user->Email . "'");
				if($row = mysqli_fetch_array($result))
					return true;
			}
		}else{
			$result = mysqli_query($this->connection, "SELECT * FROM users WHERE 	name = '" . $user->Name . "' OR 
																					phone = '" . $user->Phone . "' OR
																					email = '" . $user->Email . "'");
			if($row = mysqli_fetch_array($result))
				return true;									
		}									
		
		return false;
	}

	function registerUser(User $user){
		if(!$this->isMail($user->Email) || !$this->isPhone($user->Phone))
			die('Wrong Email or Phone. Please check the entered data');

		if($this->checkingForRegistration($user))
			die('User with this data is already registered!');

		$sql = 'INSERT INTO users SET 	name = \'' . $user->Name . '\',
									  	email = \'' . $user->Email . '\',
									  	phone = \'' . $user->Phone . '\',
									  	pass = \'' . $user->Password . '\'';

		if(mysqli_query($this->connection, $sql)){
			$user_id = mysqli_insert_id($this->connection);
			$this->connection->close();

			return $user_id;
		}else{
			$this->connection->close();
			return false;
		}
	}

	function loginUser($data = null, $id = null){
		if($data != null){
			$sql = 'SELECT * FROM users WHERE pass = \'' . $data['password'] . '\' AND ';
										  	
			//if() echo ("Телефон задан в неверном формате");
			if($this->isMail($data['phone-or-email']))
				$sql .= 'email = \'' . $data['phone-or-email'] . '\'';
			else if($this->isPhone($data['phone-or-email']))
				$sql .= 'phone = \'' . $data['phone-or-email'] . '\'';
			else
				return false;
		}elseif($id != null){
			$sql = 'SELECT * FROM users WHERE id = ' . $id;
		}


		$result = mysqli_query($this->connection, $sql);
		$this->connection->close();

		if($row = mysqli_fetch_array($result)){
			return [
				'id' => $row['id'],
				'name' => $row['name'], 
				'email' => $row['email'], 
				'phone' => $row['phone'], 
				'pass' => $row['pass']
			];
		}else{
			return false;
		}
	}

	function updateUser(User $user){
		if(!$this->isMail($user->Email) || !$this->isPhone($user->Phone))
			die('Wrong Email or Phone. Please check the entered data');

		if($this->checkingForRegistration($user, true))
			die('User with this data is already registered!');

		$sql = 'UPDATE users SET 	name = \'' . $user->Name . '\',
								  	email = \'' . $user->Email . '\',
								  	phone = \'' . $user->Phone . '\',
								  	pass = \'' . $user->Password . '\'
								  	WHERE id = ' . $user->Id;

		if(mysqli_query($this->connection, $sql)){
			$this->connection->close();
			return true;
		}else{
			$this->connection->close();
			return false;
		}
	}

	function isMail($mail){
		return filter_var($mail, FILTER_VALIDATE_EMAIL);
	}

	function isPhone($phone){
		return preg_match('/^(\+[1-9][0-9]*[0-9]*)?[0]?[1-9][0-9]*$/', $phone);
	}

}
?>