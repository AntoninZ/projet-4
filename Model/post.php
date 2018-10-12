<?php 

class Post
{
	private $_id;
	private $_date;
	private $_title;
	private $_content;
	private $_idChapter;
	private $_status;
	
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
	public function getDate() {return $this->_date;}
	public function getTitle() {return $this->_title;}
	public function getContent() {return $this->_content;}
	public function getIdChapter() {return $this->_chapter;}
	public function getStatus() {return $this->_status;}
	
	// SETTER
	public function setId($id) {$this->_id = $id;}
	public function setDate($date) {$this->_date = $date;}
	public function setTitle($title) {$this->_title = $title;}
	public function setContent($content) {$this->_content = $content;}
	public function setIdChapter($chapter) {$this->_chapter = $chapter;}
	public function setStatus($status) {$this->_status = $status;}
	
}
