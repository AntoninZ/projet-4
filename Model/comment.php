<?php 

class Comment
{
	private $_id;
	private $_idPost;
	private $_idUser;
	private $_date;
	private $_content;
	private $_moderate;
	
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
	public function getIdPost() {return $this->_idPost;}
	public function getIdUser() {return $this->_idUser;}
	public function getDate() {return $this->_date;}
	public function getContent() {return $this->_content;}
	public function getModerate() {return $this->_moderate;}
	
	// SETTER
	public function setId() {$this->_id = $id;}
	public function setIdPost() {$this->_idPost = $idPost;}
	public function setIdUser() {$this->_idAuthor = $idUser;}
	public function setDate() {$this->_date = $date;}
	public function setContent() {$this->_content = $content;}
	public function setModerate() {$this->_moderate = $moderate;}
}