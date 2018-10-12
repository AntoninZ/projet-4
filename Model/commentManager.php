<?php
	require_once("comment.php");
	
	class CommentManager
	{
		private $_db; // INSTANCE PDO
		
		
		public function __construct($db)
		{
			$this->setDb($db);
		}

		
		public function add(comment $comment)
		{
			$req = $this->_db->prepare('INSERT INTO comments(idPost, idAuthor, content, moderate) VALUES(:idPost, :idAuthor, :content, :moderate)');
			
			$req->bindValue(':idPost', $comment->getTitle());
			$req->bindValue(':idAuthor', $comment->getContent());
			$req->bindValue(':content', $comment->getStatus());
			$req->bindValue(':moderate', $comment->getModerate());
			
			$req->execute();
		}
		
		public function delete(comment $comment)
		{
			$this->_db->exec('DELETE FROM comments WHERE id = '.$comment->getId());
		}
		
		public function getModerate($moderate)
		{
			$moderate = (int) $moderate;
			
			$req = $this->_db->query('SELECT member.name, comments.content, comments.moderate FROM members, comments WHERE comments.moderate = '.$moderate);
			$donnees = $req->fetch(PDO::FETCH_ASSOC);
			
			return new comment($donnees);
		}
		
		public function getList()
		{
			$comments = [];
			
			$req = $this->_db->query('SELECT member.name, comments.content, comments.moderate FROM members, comments WHERE comments.idPost = '.$idPost);
			
			while($donnes = $req->fetch(PDO::FETCH_ASSOC))
			{
				$comments[] = new comment($donnees);
			}
			
			return $comments;
		}
		
		public function update(comment $comment)
		{
			$req = $this->_db-> prepare('UPDATE comments SET content = :content, moderate = :moderate WHERE id = :id');
			
			$req->bindValue(':id', $comment->getId(), PDO::PARAM_INT);
			$req->bindValue(':content', $comment->getContent(), PDO::PARAM_STR);
			$req->bindValue(':status', $comment->getStatus(), PDO::PARAM_INT);
			
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
