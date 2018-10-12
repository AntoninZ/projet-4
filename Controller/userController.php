<?php

require_once('Model/userManager.php');

	function signIn($username, $password) {
		
		$db = new PDO('mysql:host=localhost;dbname=projet4;charset=utf8', 'root', '');
		$manager = new UserManager($db);
		
		$user = $manager->get($username, $password);
		
		if($user == false)
		{
			return ($user);
		}
		else
		{
			return $user;
		}
	}
