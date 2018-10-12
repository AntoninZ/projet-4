<?php 

class User
{
	private $_id;
	private $_username;
	private $_password;
	private $_email;
	private $_role; // 0: admin - 1: writer - 2 : reader;

	
	public function __construct(array $donnees)
	{
		$this->hydrate($donnees);
	}
	
	public function hydrate(array $donnees)
	{
		foreach ($donnees as $key => $value)
		{
			// On récupère le nom du setter correspondant à l'attribut.
			$method = 'set'.ucfirst($key);
			
			// Si le setter correspondant existe.
			if (method_exists($this, $method))
			{
			  // On appelle le setter.
			  $this->$method($value);
			}
		}
	}
	
	// GETTER
	public function getId() {return $this->_id;}
	public function getUsername() {return $this->_username;}
	public function getPassword() {return $this->_password;}
	public function getEmail() {return $this->_email;}
	public function getRole() {return $this->_role;}

	
	// SETTER
	public function setId($id) {$this->_id = $id;}
	public function setUsername($username) {$this->_username = $username;}
	public function setPassword($password) {$this->_password = password_hash($password, PASSWORD_DEFAULT);}
	public function setEmail($email) {$this->_email = $email;}
	public function setRole($role) {$this->_role = $role;}

}