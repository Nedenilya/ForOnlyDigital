<?php 

require_once "Controllers/DBController.php";

class User
{
	public $Id;
	public $Name;
	public $Phone;
	public $Email;
	private $Passwword;

	function __construct($name = '', $phone = '', $email = '', $password = '')
	{
		$this->Name = $name;
		$this->Phone = $phone;
		$this->Email = $email;
		$this->Password = $password;
	}

	function register(){
		$db = new DBController();
		$db->connect();
		$this->Id = $db->registerUser($this);
		return $this;
	}

	function login($data){
		$db = new DBController();
		$db->connect();

		if($user = $db->loginUser($data)){
			$this->Id = $user['id'];
			$this->Name = $user['name'];
			$this->Phone = $user['phone'];
			$this->Email = $user['email'];
			$this->Password = $user['pass'];
			return true;
		}else{
			return false;
		}
	}

	function loginById($id){
		$db = new DBController();
		$db->connect();

		if($user = $db->loginUser(null, $id)){
			$this->Id = $user['id'];
			$this->Name = $user['name'];
			$this->Phone = $user['phone'];
			$this->Email = $user['email'];
			$this->Password = $user['pass'];
			return true;
		}else{
			return false;
		}
	}

	function update($data){
		$db = new DBController();
		$db->connect();

		$this->Id = $data['id'];
		$this->Name = $data['name'];
		$this->Phone = $data['phone'];
		$this->Email = $data['email'];
		$this->Password = $data['password'];

		if($db->updateUser($this))
			return true;
		else
			return false;	
	}

	function getPassword(){
		if($_COOKIE['USER_ID'] == $this->Id)
			return $this->Password;
		else
			return "Undefined";
	}

}

?>