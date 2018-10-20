<?php
	require_once("Model/user.php");
	
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
			
			$req->bindValue(':username', $user->getUsername());
			$req->bindValue(':password', password_hash($user->getPassword(), PASSWORD_DEFAULT));
			$req->bindValue(':role', $user->getRole());
			
			$req->execute();
			
		}
		
		public function delete(User $user)
		{
			$req = $this->_db->prepare('DELETE * FROM users WHERE id = :id');
			
			$req->bindValue(':id', $user->getId());
			
			$req->execute();
			
			return true;
		}
		
		
		public function update(User $user)
		{
			$req = $this->_db-> prepare('UPDATE users SET username = :username, role = :role WHERE id = :id');
			
			$req->bindValue(':id', $user->getId(), PDO::PARAM_INT);
			$req->bindValue(':username', $user->getUsername(), PDO::PARAM_STR);
			$req->bindValue(':role', $user->getRole(), PDO::PARAM_STR);
			$req->execute();
			
			return true;
		}
		
		public function get(User $user)
		{	
			$verify = $user->getUsername();
			if(isset($verify))
			{
				$req = $this->_db->query('SELECT * FROM users WHERE username = "' . $user->getUsername() . '"');
			}
			else
			{
				$req = $this->_db->query('SELECT * FROM users WHERE id = "' . $user->getId() . '"');
			}
			
			$donnees = $req->fetch(PDO::FETCH_ASSOC);
			
			if($donnees){
				return $userInfo = new User($donnees);	
			}
			else{
				throw new Exception('Pseudo incorrect.');
			}
		}
		
		public function getList()
		{
			$users = [];
			
			$req = $this->_db->query('SELECT * FROM users ORDER BY id ASC');
			
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