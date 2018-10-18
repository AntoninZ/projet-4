<?php

require_once('Model/userManager.php');

	function getUserLogin() {
		
		$username = $_POST['username'];
		$password = $_POST['password'];
		
		$userReq = new User([
			'username' => $username,
			'password'  => $password
		]);
		
		$db = new PDO('mysql:host=localhost;dbname=projet4;charset=utf8', 'root', '');
		
		$manager = new UserManager($db);
		$donnees = $manager->get($userReq);
		
		
		if(password_verify($password, $donnees->getPassword()))
		{
			return $donnees;
		}
			else{
				return $username."<br />".$password;
			}
	}
	
	function addUser()
	{
		$user = new User([
			'username' => $_POST['username2'],
			'password' => $_POST['password2'],
			'role' => 'Lecteur'
		]);
		
		$db = new PDO('mysql:host=localhost;dbname=projet4;charset=utf8', 'root', '');
		
		$manager = new UserManager($db);
		$manager->add($user);
		
		return $user;
	}
	
	function getUserList()
	{
		$db = new PDO('mysql:host=localhost;dbname=projet4;charset=utf8', 'root', '');
		$manager = new UserManager($db);
		$users = $manager->getList();
		return $users;
	}
	
	function getUserInfo()
	{
		$userReq = new User([
			'id' => $_GET['id']
		]);
		
		$db = new PDO('mysql:host=localhost;dbname=projet4;charset=utf8', 'root', '');
		$manager = new UserManager($db);
		$user = $manager->get($userReq);
		
		return $user;
	}
	
	function updateUser()
	{
		$userUpdate = new User([
		'id' => $_GET['id'],
		'username' => $_POST['username'],
		'role' => $_POST['role']
		]);
		
		$db = new PDO('mysql:host=localhost;dbname=projet4;charset=utf8', 'root', '');
		$manager = new UserManager($db);
		
		$manager->update($userUpdate);
	}
