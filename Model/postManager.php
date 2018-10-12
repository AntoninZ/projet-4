<?php
	require_once("post.php");
	
	class PostManager
	{
		private $_db; // INSTANCE PDO
		
		
		public function __construct($db)
		{
			$this->setDb($db);
		}
		
		
		public function add(Post $article)
		{
			$req = $this->_db->prepare('INSERT INTO articles(title, content, chapter, status) VALUES(:title, :content, :chapter, :status)');
			
			$req->bindValue(':title', $article->getTitle());
			$req->bindValue(':content', $article->getContent());
			$req->bindValue(':chapter', $chapter->getChapter());
			$req->bindValue(':status', $article->getStatus());
			
			$req->execute();
		}
		
		public function delete(Post $article)
		{
			$this->_db->exec('DELETE FROM articles WHERE id = '.$article->getId());
		}
		
		public function get($id)
		{
			$id = (int) $id;
			
			$req = $this->_db->query('SELECT date, title, content, idChapter, status FROM articles WHERE id = '.$id);
			$donnees = $req->fetch(PDO::FETCH_ASSOC);
			
			return $article = new Post($donnees);
		}
		
		public function getList()
		{
			$articles = [];
			
			$req = $this->_db->query('SELECT id, date, title, content, idChapter, status FROM articles ORDER BY date DESC');
			
			while($donnees = $req->fetch(PDO::FETCH_ASSOC))
			{
				$articles[] = new Post($donnees);
			}
			
			return $articles;
		}
		
		public function update(Post $article)
		{
			$req = $this->_db-> prepare('UPDATE articles SET date = :date, title = :title, content = :content, idChapter = :chapter, status = :status WHERE id = :id');
			
			$req->bindValue(':date', $article->getDate(), PDO::PARAM_STR);
			$req->bindValue(':title', $article->getTitle(), PDO::PARAM_STR);
			$req->bindValue(':content', $article->getContent(), PDO::PARAM_STR);
			$req->bindValue(':Chapter', $article->getIdChapter(), PDO::PARAM_STR);
			$req->bindValue(':status', $article->getStatus(), PDO::PARAM_INT);
			
			$req->execute();
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
	

	// Méthode pour récuperer les données de la méthode get()
	// $db = new PDO('mysql:host=localhost;dbname=projet4;charset=utf8', 'root', '');
	// $manager = new PostManager($db);
	
	// $article = $manager->get('4');
	// echo $article->getTitle();
	// echo $article->getContent();
	// echo $article->getStatus();
	
	