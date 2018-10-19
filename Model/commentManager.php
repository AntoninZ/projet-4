<?php
	require_once("comment.php");
	
	class CommentManager
	{
		private $_db; // INSTANCE PDO
		
		
		public function __construct($db)
		{
			$this->setDb($db);
		}

		public function get($id)
		{
			
			$req = $this->_db->query('SELECT * FROM comments WHERE id = '.$id);
			$donnees = $req->fetch(PDO::FETCH_ASSOC);
			
			return $comment = new Comment($donnees);
		}
		
		public function findIdUser($username)
		{
			$req = $this->_db->query('SELECT id FROM users WHERE username = \'' .$username. '\'');
			$donnees = $req->fetch();
			
			return $donnees['id'];
		}
		
		public function add(comment $comment)
		{
			$req = $this->_db->prepare('INSERT INTO comments(idPost, idAuthor, content, moderate, reportCount) VALUES(:idPost, :idAuthor, :content, :moderate, :reportCount)');
			$req->bindValue(':idPost', $comment->getIdPost());
			$req->bindValue(':idAuthor', $comment->getIdUser());
			$req->bindValue(':content', $comment->getContent());
			$req->bindValue(':moderate', $comment->getModerate());
			$req->bindValue(':reportCount', $comment->getReportCount());
			$req->execute();
		}
		
		public function delete(Comment $comment)
		{
			$this->_db->exec('DELETE FROM comments WHERE id =' .$comment->getId());
		}
		
		public function getModerate($moderate)
		{
			$moderate = (int) $moderate;
			
			$req = $this->_db->query('SELECT member.name, comments.content, comments.moderate FROM members, comments WHERE comments.moderate = '.$moderate);
			$donnees = $req->fetch(PDO::FETCH_ASSOC);
			
			return new comment($donnees);
		}
		
		public function getList($id)
		{
			$comments = [];
			
			$req = $this->_db->prepare('
				SELECT comments.id, comments.idPost, comments.date, comments.content, users.username 
				FROM comments 
				INNER JOIN articles ON comments.idPost = articles.id AND articles.id = :id 
				INNER JOIN users ON comments.idAuthor = users.id ORDER BY comments.date DESC
			');
			$req->bindValue(':id', $id);
			$req->execute();
			
			while($donnees = $req->fetch(PDO::FETCH_ASSOC))
			{
				$comments[] = new comment($donnees);
			}
			
			return $comments;
		}
		
		public function getListModerate()
		{
			$comments = [];
			
			$req = $this->_db->query('SELECT * FROM comments WHERE moderate = 1 ORDER BY reportCount DESC');
			
			while($donnees = $req->fetch(PDO::FETCH_ASSOC))
			{
				$comments[] = new comment($donnees);
			}
			
			return $comments;
		}
		
		public function update(comment $comment)
		{
			$req = $this->_db-> prepare('UPDATE comments SET moderate = :moderate, reportCount = :reportCount WHERE id = :id');		
			$req->bindValue(':id', $comment->getId(), PDO::PARAM_INT);
			$req->bindValue(':moderate', $comment->getModerate(), PDO::PARAM_INT);
			$req->bindValue(':reportCount', $comment->getReportCount(), PDO::PARAM_INT);
			$req->execute();
		}
		
		
		// SETTER
		public function setDb(PDO $db)
		{
			$this->_db = $db;
		}

	}
	
	
	$db = new PDO('mysql:host=localhost;dbname=projet4;charset=utf8', 'root', '');
	$manager = new CommentManager($db);
