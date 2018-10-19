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
	
	$username = $_SESSION['username'];
	
	$idUser = $manager->findIdUser($username);
	
	$comment = new Comment([
		'idPost' => $_GET['id'],
		'idUser' => $idUser,
		'content' => $_POST['content'],
		'moderate' => '1',
		'reportCount' => '0'
	]);		
	
	$manager->add($comment);
	
	return $idUser;
}

function validateComment()
{
	$comment = new Comment([
		'id' => $_GET['id'],
		'moderate' => '0',
		'reportCount' => '0'
	]);
	
	$db = new PDO('mysql:host=localhost;dbname=projet4;charset=utf8', 'root', '');
	$manager = new commentManager($db);
	
	$manager->Update($comment);
	
}

function deleteComment()
{
	$commentDelete = new Comment([
		'id' => $_GET['id']
	]);
	
	$db = new PDO('mysql:host=localhost;dbname=projet4;charset=utf8', 'root', '');
	$manager = new CommentManager($db);
	$manager->delete($commentDelete);
}

function getComment()
{
	$db = new PDO('mysql:host=localhost;dbname=projet4;charset=utf8', 'root', '');
	$manager = new CommentManager($db);
	$id = $_GET['idComment'];
	$comment = $manager->get($id);
	return $comment;
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
	$id = (int) $_GET['id'];
	$db = new PDO('mysql:host=localhost;dbname=projet4;charset=utf8', 'root', '');
	$manager = new commentManager($db);
	$comments = $manager->getList($id);
	return $comments;
}