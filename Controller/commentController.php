<?php 
require_once('Model/CommentManager.php');

function getListComment()
{
	$db = new PDO('mysql:host=localhost;dbname=projet4;charset=utf8', 'root', '');
	$manager = new commentManager($db);
	$comments = $manager->getListModerate();
	
	return $comments;
	
}

function addComment()
{
	$db = new PDO('mysql:host=localhost;dbname=projet4;charset=utf8', 'root', '');
	$manager = new commentManager($db);
	
	if(isset($_SESSION['username']))
	{
		$username = $_SESSION['username'];
		$idUser = $manager->findIdUser($username);
		
		if(!empty($idUser))
		{
			if(isset($_GET['id']))
			{
				if(isset($_POST['content']))
				{
					if(!empty($_POST['content']))
					{
						$comment = new Comment([
							'idPost' => intval($_GET['id']),
							'idUser' => $idUser,
							'content' => $_POST['content'],
							'moderate' => '1',
							'reportCount' => '0'
						]);		
					
						$manager->add($comment);
						
						return $idUser;
					}
					else
					{
						throw new Exception('Erreur: Le champs "commentaire" est vide.');
					}
				}
				else
				{
					throw new Exception('Erreur: Le champs "commentaire" n\'a pas pu être récupéré.');
				}
			}
			else
			{				
				throw new Exception('Erreur : L\'identifiant de l\'article est erroné ou inexistant.');
			}
		}
		else
		{
			throw new Exception('Erreur : Votre identifiant d\'utilisateur est introuvable.');
		}
	}
	else
	{
		throw new Exception('Erreur : Vous devez être connecté pour ajouter un commentaire.');
	}
}

function validateComment()
{
	if(isset($_GET['id']) && !empty($_GET['id']))
	{
		$comment = new Comment([
			'id' => intval($_GET['id']),
			'moderate' => '0',
			'reportCount' => '0'
		]);
		
		$db = new PDO('mysql:host=localhost;dbname=projet4;charset=utf8', 'root', '');
		$manager = new commentManager($db);
		
		$manager->Update($comment);
	}
	else
	{
		throw new Exception('Erreur : L\'identifiant du commentaire est érroné ou non spécifié.');
	}
	
}

function deleteComment()
{
	if(isset($_GET['id']) && !empty($_GET['id']))
	{
		$commentDelete = new Comment(['id' => intval($_GET['id'])]);
		
		$db = new PDO('mysql:host=localhost;dbname=projet4;charset=utf8', 'root', '');
		$manager = new CommentManager($db);
		$manager->delete($commentDelete);
	}
	else
	{
		throw new Exception('Erreur : L\'identifiant du commentaire est érroné ou non spécifié.');
	}
}

function getComment()
{
	if(isset($_GET['id']) && !empty($_GET['id']))
	{
		$db = new PDO('mysql:host=localhost;dbname=projet4;charset=utf8', 'root', '');
		$manager = new CommentManager($db);
		$id = intval($_GET['idComment']);
		$comment = $manager->get($id);
		return $comment;
	}
	else
	{
		throw new Exception('Erreur : L\'identifiant du commentaire est érroné ou non spécifié.');
	}
}

function reportComment(Comment $comment)
{
	$db = new PDO('mysql:host=localhost;dbname=projet4;charset=utf8', 'root', '');
	$manager = new CommentManager($db);
	
	$reportCount = intval($comment->getReportCount()) + 1;
	
	$comment->setModerate('1');
	$comment->setReportCount($reportCount);
	
	$manager->Update($comment);
}

function getListCommentPost()
{
	if(isset($_GET['id']) && !empty($_GET['id']))
	{
		$id = intval($_GET['id']);
		$db = new PDO('mysql:host=localhost;dbname=projet4;charset=utf8', 'root', '');
		$manager = new commentManager($db);
		$comments = $manager->getList($id);
		
		return $comments;
	}
	else
	{
		throw new Exception('Erreur : L\'identifiant du commentaire est érroné ou non spécifié.');
	}
}