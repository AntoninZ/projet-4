<?php 
require_once('Model/CommentManager.php');

function getListComment()
{
	$db = new PDO('mysql:host=localhost;dbname=projet4;charset=utf8', 'root', '');
	$manager = new commentManager($db);
	$comments = $manager->getListModerate();
	return $comments;
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
	
	$donnees = $manager->Update($comment);
	
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