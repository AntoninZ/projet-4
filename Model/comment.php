<?php 

class Comment
{
	private $_id;
	private $_idPost;
	private $_idUser;
	private $_date;
	private $_content;
	private $_moderate;
	private $_reportCount;
	
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
	public function getReportCount() {return $this->_reportCount;}
	
	// SETTER
	public function setId($id) {$this->_id = $id;}
	public function setIdPost($idPost) {$this->_idPost = $idPost;}
	public function setIdUser($idUser) {$this->_idAuthor = $idUser;}
	public function setDate($date) {$this->_date = $date;}
	public function setContent($content) {$this->_content = $content;}
	public function setModerate($moderate) {$this->_moderate = $moderate;}
	public function setReportCount($reportCount) {$this->_reportCount = $reportCount;}
}