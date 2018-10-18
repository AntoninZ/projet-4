<?php
	require_once("chapter.php");
	
	class ChapterManager
	{
		private $_db; // INSTANCE PDO
		
		
		public function __construct($db)
		{
			$this->setDb($db);
		}
		
		
		public function add(Chapter $chapter)
		{
			$req = $this->_db->prepare('INSERT INTO chapters (name) VALUES (:name)');
			
			$req->bindValue(':name', $chapter->getName(), PDO::PARAM_STR);
			
			$req->execute();
		}
		
		public function delete(Chapter $chapter)
		{
			$this->_db->exec('DELETE FROM chapters WHERE id = '.$chapter->getId());
		}
		
		public function get($id)
		{
			$id = (int) $id;
			
			$req = $this->_db->query('SELECT * FROM chapters WHERE id = '.$id);
			$donnees = $req->fetch(PDO::FETCH_ASSOC);
			
			return $chapter = new Chapter($donnees);
		}
		
		public function getListChapter()
		{
			$chapters = [];
			
			$req = $this->_db->query('SELECT * FROM chapters ORDER BY id');
			
			while($donnees = $req->fetch(PDO::FETCH_ASSOC))
			{
				$chapters[] = new Chapter($donnees);
			}
			
			return $chapters;
		}
		
		public function update(Chapter $chapter)
		{
			$req = $this->_db-> prepare('UPDATE chapters SET name = :name WHERE id = :id');
			
			$req->bindValue(':id', $chapter->getId(), PDO::PARAM_INT);
			$req->bindValue(':name', $chapter->getName(), PDO::PARAM_STR);

			
			$req->execute();
		}
		
		public function getLastChapterId()
		{
			$req = $this->_db->query('SELECT id FROM chapters ORDER BY id DESC LIMIT 0,1');
			$donnees = $req->fetch(PDO::FETCH_ASSOC);
			
			if($donnees)
			{
				$chapter = new Chapter($donnees);
				$id = intval($chapter->getId())+1;
				$chapter->setId($id);
			}
			else
			{
				$chapter = new Chapter(['id' => '1']);
				$req = $this->_db->query('ALTER TABLE articles AUTO_INCREMENT=1');
			}
			
			return $chapter;
		}
		// SETTER
		public function setDb(PDO $db)
		{
			$this->_db = $db;
		}
		public function getDb()
		{
			return $this->_db;
		}
	}