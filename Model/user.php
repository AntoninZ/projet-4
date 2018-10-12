<?php 

class User
{
	private $_id;
	private $_name;
	private $_password;
	private $_email;
	private $_role, // 0: admin - 1: writer - 2 : reader;

	
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
	public function getName() {return $this->_name;}
	public function getPassword() {return $this->_password;}
	public function getEmail() {return $this->_email;}
	public function getRole() {return $this->_role;}

	
	// SETTER
	public function setId() {$this->_id = $id;}
	public function setName() {$this->_name = $name;}
	public function setPassword() {$this->_password = password_hash($password, PASSWORD_DEFAULT);}
	public function setEmail() {$this->_email = $email;}
	public function setEmail() {$this->_role = $role;}

}