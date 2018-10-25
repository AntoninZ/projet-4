<?php

require_once('Model/userManager.php');
require_once $_SERVER['DOCUMENT_ROOT'].('/Controller/connectController.php');

	function getUserLogin() {
		$userReq = new User([
			'username' => $_POST['username'],
			'password'  => $_POST['password']
		]);
		
		
		$db = connect();
		
		$manager = new UserManager($db);
		$donnees = $manager->verify($userReq);
		
		if($donnees != FALSE)
		{
			if(password_verify($_POST['password'], $donnees->getPassword()))
			{
				return $donnees;
			}
			else
			{
				throw new Exception('Pseudo ou mot de passe incorrect.');	
			}
		}
		else
		{
			throw new Exception('Pseudo ou mot de passe incorrect.');
		}
	}
	
	function addUser()
	{
		$passwordCheck = $_POST['passwordCheck'];
		
		if($_POST['newPassword'] == $_POST['passwordCheck'])
		{			
			$username = ucfirst(strtolower($_POST['newUsername']));
			$password = $_POST['newPassword'];
			
			$user = new User([
				'username' => $username,
				'password' => $password,
				'role' => 'Lecteur'
			]);
			
			$db = connect();
			$manager = new UserManager($db);
			$usernameVerify = $manager->verify($user);
			
			if($usernameVerify != FALSE)
			{
				throw new Exception('Ce pseudo est déjà utilisé.');
			}
			else
			{
				$manager->add($user);
				return $user;
			}	
		}
		else
		{
			throw new Exception('Les mots de passe ne sont pas identiques.');
		}	
	}
	
	function getUserList()
	{
		$db = connect();
		$manager = new UserManager($db);
		$users = $manager->getList();
		return $users;
	}
	
	function getUser()
	{
		if(isset($_GET['id']))
		{	
				$userReq = new User(['id' => intval($_GET['id'])]);
				
				$db = connect();
				$manager = new UserManager($db);
				$user = $manager->get($userReq);
				
				return $user;			
		}
		else
		{
			throw new Exception('Erreur : l\'identifiant du membre n\'est pas spécifié.');
		}
	}
	
	function updateUser()
	{
		
		if(isset($_GET['id']))
		{
			if(isset($_POST['username']) && !empty($_POST['username']))
			{
				if(isset($_POST['role']))
				{	
					if($_POST['role'] == 'Administrateur' || $_POST['role'] == 'Lecteur')
					{
						$userUpdate = new User([
						'id' => intval($_GET['id']),
						'username' => $_POST['username'],
						'role' => $_POST['role']
						]);
						
						$db = connect();
						$manager = new UserManager($db);
						$manager->update($userUpdate);
					}
					else
					{
						throw new Exception('Erreur : le rôle du membre est erroné.');
					}
				}
				else
				{
					throw new Exception('Erreur : le champs "rôle" n\'a pas pu être récupéré.');
				}
			}
			else
			{
				throw new Exception('Erreur : le champs "pseudo" est vide ou n\'a pas pu être récupéré.');
			}
		}
		else
		{
			throw new Exception('Erreur : l\'identifiant de l\'utilisateur est erroné.');
		}
	}
	
	function deleteUser()
	{
		if(isset($_GET['id']))
		{
			$user = new User(['id' => intval($_GET['id'])]);
			$db = connect();
			$manager = new UserManager($db);
			return $user = $manager->delete($user);
		}
		else
		{
			throw new Exception('Erreur : l\'identifiant du membre n\'est pas spécifié.');
		}
	}
