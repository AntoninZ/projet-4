<?php
	require_once $_SERVER['DOCUMENT_ROOT'].("/Model/user.php");
	
	class UserManager
	{
		private $_db;
		
		public function __construct($db)
		{
			$this->setDb($db);
		}
		
		public function add(User $user)
		{
			$req = $this->_db->prepare('INSERT INTO users(username, password, role) VALUES (:username, :password, :role)');
			$req->bindValue(':username', $user->getUsername(), PDO::PARAM_STR);
			$req->bindValue(':password', password_hash($user->getPassword(), PASSWORD_DEFAULT), PDO::PARAM_STR);
			$req->bindValue(':role', $user->getRole(), PDO::PARAM_STR);
			$req->execute();	
		}
		
		public function delete(User $user)
		{
			$req = $this->_db->prepare('DELETE FROM users WHERE id = :id');
			$req->bindValue(':id', $user->getId(), PDO::PARAM_INT);
			$req->execute();
		}
		
		public function update(User $user)
		{
			$req = $this->_db-> prepare('UPDATE users SET username = :username, role = :role WHERE id = :id');
			$req->bindValue(':id', $user->getId(), PDO::PARAM_INT);
			$req->bindValue(':username', $user->getUsername(), PDO::PARAM_STR);
			$req->bindValue(':role', $user->getRole(), PDO::PARAM_STR);
			$req->execute();
		}
		
		public function get(User $user)
		{	
			$req = $this->_db->prepare('SELECT * FROM users WHERE id = :id');
			$req->bindValue(':id', $user->getId(), PDO::PARAM_INT);
			$req->execute();
			
			$donnees = $req->fetch(PDO::FETCH_ASSOC);
			
			if($donnees)
			{
				return $userInfo = new User($donnees);	
			}
			else
			{
				throw new Exception('Ce membre n\'existe pas (identifiant érroné). ');
			}
		}
		
		public function verify(User $user)
		{
			$req = $this->_db->prepare('SELECT * FROM users WHERE username = :username');
			$req->bindValue(':username', $user->getUsername(), PDO::PARAM_STR);
			$req->execute();
			
			$donnees = $req->fetch(PDO::FETCH_ASSOC);
			
			if(!empty($donnees))
			{
				return $user = new User($donnees);
			}
			else
			{
				return false;
			}
		}
		
		public function getList()
		{
			
			$users = [];
			
			$req = $this->_db->query('SELECT * FROM users ORDER BY id LIMIT 18446744073709551615 OFFSET 2 ');
			
			while($donnees = $req->fetch(PDO::FETCH_ASSOC))
			{
				$users[] = new User($donnees);
			}	
			
			return $users;
		}
		
		// SETTER
		public function setDb(PDO $db)
		{
			$this->_db = $db;
		}

	}