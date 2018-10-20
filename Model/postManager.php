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
			$req = $this->_db->prepare('INSERT INTO articles(id, title, content, idChapter) VALUES (:id, :title, :content, :idChapter)');
			
			$req->bindValue(':id', $article->getId(), PDO::PARAM_INT);
			$req->bindValue(':title', $article->getTitle(), PDO::PARAM_STR);
			$req->bindValue(':content', $article->getContent(), PDO::PARAM_STR);
			$req->bindValue(':idChapter', $article->getIdChapter(), PDO::PARAM_INT);
			
			$req->execute();
		}
		
		public function delete($id)
		{
			$this->_db->exec('DELETE FROM articles WHERE id = '.$id);
		}
		
		public function get($id)
		{
			$id = (int) $id;
			
			$req = $this->_db->query('SELECT articles.*, chapters.name FROM articles INNER JOIN chapters ON articles.idChapter = chapters.id AND articles.id = '.$id);
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
			$req = $this->_db-> prepare('UPDATE articles SET date = :date, title = :title, content = :content, idChapter = :idChapter WHERE id = :id');
			
			$req->bindValue(':id', $article->getId(), PDO::PARAM_INT);
			$req->bindValue(':date', $article->getDate(), PDO::PARAM_STR);
			$req->bindValue(':title', $article->getTitle(), PDO::PARAM_STR);
			$req->bindValue(':content', $article->getContent(), PDO::PARAM_STR);
			$req->bindValue(':idChapter', $article->getIdChapter(), PDO::PARAM_STR);
			
			$req->execute();
		}
		
		public function getLastPostId()
		{
			$req = $this->_db->query('SELECT id FROM articles ORDER BY id DESC LIMIT 0,1');
			$donnees = $req->fetch(PDO::FETCH_ASSOC);
			
			if($donnees)
			{
				$article = new Post($donnees);
				$id = intval($article->getId())+1;
				$article->setId($id);
			}
			else
			{
				$article = new Post(['id' => '1']);
				$req = $this->_db->query('ALTER TABLE articles AUTO_INCREMENT=1');
			}
			return $article;
		}
		
		public function getPostByIdChapter($id)
		{
			$titles = [];
			
			$req = $this->_db->query('SELECT title, id FROM articles WHERE idChapter ='.$id);
			while($donnees = $req->fetch())
			{
				$titles[] = ['title' => $donnees['title'], 'id' => $donnees['id']];
			}
			
			return $titles;
		}
		
		public function CountPost()
		{
			$req = $this->_db->query('SELECT COUNT(id) FROM articles');
			$donnees = $req->fetch();
			
			return $donnees['COUNT(id)'];
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
	

	