<?php
	require_once("Model/user.php");
	
	class UserManager
	{
		private $_db; // INSTANCE PDO
		
		
		public function __construct($db)
		{
			$this->setDb($db);
		}
		
		public function add(User $user)
		{
			
			$req = $this->_db->prepare('INSERT INTO users(name, password, email, role) VALUES(:name, :password, :email, :role)');
			
			$req->bindValue(':name', $user->getName());
			$req->bindValue(':password', $user->getPassword());
			$req->bindValue(':email', $user->getEmail());
			$req->bindValue(':role', $user->getRole());
			
			$req->execute();
		}
		
		public function delete(User $user)
		{
			$this->_db->exec('DELETE * FROM users WHERE id = '.$user->getId());
		}
		
		
		public function update(User $user)
		{
			$req = $this->_db-> prepare('UPDATE users SET email = :email, role = :role WHERE id = :id');
			
			$req->bindValue(':id', $user->getId(), PDO::PARAM_INT);
			$req->bindValue(':email', $user->getEmail(), PDO::PARAM_STR);
			$req->bindValue(':role', $user->getRole(), PDO::PARAM_INT);
			
			$req->execute();
		}
		
		public function get($username, $password)
		{
			
			$req = $this->_db->query('SELECT * FROM users WHERE username = "' .$username. '" AND password = "' .$password. '"');
			$donnees = $req->fetch(PDO::FETCH_ASSOC);
			
			if($donnees)
			{
				return $user = new User($donnees);
			}
			else
			{
				return $donnees;
			}
		}
		
		// SETTER
		public function setDb(PDO $db)
		{
			$this->_db = $db;
		}

	}
	
	
	$db = new PDO('mysql:host=localhost;dbname=projet4;charset=utf8', 'root', '');
	$manager = new userManager($db);
