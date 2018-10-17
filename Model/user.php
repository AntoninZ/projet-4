<?php 

class User
{
	private $_id;
	private $_username;
	private $_password;
	private $_role;

	
	public function __construct(array $donnees)
	{
		$this->hydrate($donnees);
	}
	
	public function hydrate(array $donnees)
	{
		foreach ($donnees as $key => $value)
		{
			$method = 'set'.ucfirst($key);
			
			if (method_exists($this, $method))
			{
			  $this->$method($value);
			}
		}
	}
	
	// GETTER
	public function getId() {return $this->_id;}
	public function getUsername() {return $this->_username;}
	public function getPassword() {return $this->_password;}
	public function getRole() {return $this->_role;}

	
	// SETTER
	public function setId($id) {$this->_id = $id;}
	public function setUsername($username) {$this->_username = $username;}
	public function setPassword($password) {$this->_password = $password;}
	public function setRole($role) {$this->_role = $role;}

}