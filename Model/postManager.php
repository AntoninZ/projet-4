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
			$req = $this->_db->prepare('INSERT INTO articles(title, content, idChapter, status) VALUES (:title, :content, :idChapter, :status)');
			
			$req->bindValue(':title', $article->getTitle(), PDO::PARAM_STR);
			$req->bindValue(':content', $article->getContent(), PDO::PARAM_STR);
			$req->bindValue(':idChapter', $article->getIdChapter(), PDO::PARAM_INT);
			$req->bindValue(':status', $article->getStatus(), PDO::PARAM_INT);
			
			$req->execute();
		}
		
		public function delete($id)
		{
			$this->_db->exec('DELETE FROM articles WHERE id = '.$id);
		}
		
		public function get($id)
		{
			$id = (int) $id;
			
			$req = $this->_db->query('SELECT * FROM articles WHERE id = '.$id);
			$donnees = $req->fetch(PDO::FETCH_ASSOC);
			
			return $article = new Post($donnees);
		}
		
		public function getList()
		{
			$articles = [];
			
			$req = $this->_db->query('SELECT * FROM articles ORDER BY date DESC');
			
			while($donnees = $req->fetch(PDO::FETCH_ASSOC))
			{
				$articles[] = new Post($donnees);
			}
			
			return $articles;
		}
		
		public function update(Post $article)
		{
			$req = $this->_db-> prepare('UPDATE articles SET date = :date, title = :title, content = :content, idChapter = :idChapter, status = :status WHERE id = :id');
			
			$req->bindValue(':id', $article->getId(), PDO::PARAM_INT);
			$req->bindValue(':date', $article->getDate(), PDO::PARAM_STR);
			$req->bindValue(':title', $article->getTitle(), PDO::PARAM_STR);
			$req->bindValue(':content', $article->getContent(), PDO::PARAM_STR);
			$req->bindValue(':idChapter', $article->getIdChapter(), PDO::PARAM_STR);
			$req->bindValue(':status', $article->getStatus(), PDO::PARAM_INT);
			
			$req->execute();
		}
		
		public function getLastPostId()
		{
			$req = $this->_db->query('SELECT id FROM articles ORDER BY id DESC LIMIT 0,1');
			$id = $req->fetch(PDO::FETCH_ASSOC);
			
			if($id != NULL)
			{
				$id = intval($id)+1;
			}
			else
			{
				$id = 1;
				$req = $this->_db->query('ALTER TABLE articles AUTO_INCREMENT=1');
			}
			return $id;
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
	
	