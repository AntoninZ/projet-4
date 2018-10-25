<?php
require_once $_SERVER['DOCUMENT_ROOT'].('/Controller/connectController.php');
require_once $_SERVER['DOCUMENT_ROOT'].('/Model/postManager.php');


function getPost() {		
	$db = connect();
	$manager = new PostManager($db);		
	$id = $_GET['id'];		
	$article = $manager->get($id);
	return $article;
}

function getList() {
	$db = connect();
	$manager = new PostManager($db);
	$article = $manager->getList();
	return $article;
}

function updatePost() {
	$articleUpdate = new Post([
		'id' => $_GET['id'],
		'date' => $_POST['date'],
		'title' => $_POST['title'],
		'content' => $_POST['content'],
		'idChapter' => $_POST['idChapter'],
	]);
	
	$db = connect();
	$manager = new PostManager($db);
	$article = $manager->update($articleUpdate);
}

function addPost() {
	date_default_timezone_set("Europe/Paris");
	$article = new Post([
		'id' => $_GET['id'],
		'date' => date("Y-m-d H:i:s"),
		'title' => $_POST['title'],
		'content' => $_POST['content'],
		'idChapter' => $_POST['idChapter'],
	]);
	
	$db = connect();
	$manager = new PostManager($db);
	$manager->add($article);
	
	return $article;
}

function lastPostId(){
	$db = connect();
	$manager = new PostManager($db);		
	
	$article = $manager->getLastPostId();
	return $article;
}

function deletePost()
{	
	$article = new Post(['id' => $_GET['id']]);

	$db = connect();
	$manager = new PostManager($db);
	$manager->delete($article);
}

function CountPost()
{
	$db = connect();
	$manager = new PostManager($db);		
	
	$donnees = $manager->CountPost();
	return $donnees;
}

