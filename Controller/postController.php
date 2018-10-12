<?php
require_once('Model/postManager.php');

function getPost() {		
		$db = new PDO('mysql:host=localhost;dbname=projet4;charset=utf8', 'root', '');
		$manager = new PostManager($db);		
		$id = $_GET['id'];		
		$article = $manager->get($id);
		return $article;
}

