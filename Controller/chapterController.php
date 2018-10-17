<?php
require_once('Model/ChapterManager.php');

function getChapter($idChapter) {		
	$db = new PDO('mysql:host=localhost;dbname=projet4;charset=utf8', 'root', '');
	$manager = new ChapterManager($db);		
	if($idChapter)
	{
		$id = $idChapter;
	}
	else{
		$id = $_GET['id'];
	}
	
	$chapter = $manager->get($id);
	return $chapter;
}

function getListChapter() {
	$db = new PDO('mysql:host=localhost;dbname=projet4;charset=utf8', 'root', '');
	$manager = new ChapterManager($db);
	$chapters = $manager->getListChapter();
	return $chapters;
}

function updateChapter() {
	$chapterUpdate = new Chapter([
		'id' => $_GET['id'],
		'name' => $_POST['name'],
	]);
	
	$db = new PDO('mysql:host=localhost;dbname=projet4;charset=utf8', 'root', '');
	$manager = new chapterManager($db);
	$chapter = $manager->update($chapterUpdate);
}

function addChapter() {
	$chapter = new Chapter([
		'id' => $_GET['id'],
		'name' => $_POST['name'],
	]);
	
	$db = new PDO('mysql:host=localhost;dbname=projet4;charset=utf8', 'root', '');
	$manager = new ChapterManager($db);
	$manager->add($chapter);
	
	return $chapter;
}

function lastPostIdChapter(){
	$db = new PDO('mysql:host=localhost;dbname=projet4;charset=utf8', 'root', '');
	$manager = new ChapterManager($db);		
	
	$id = $manager->getLastChapterId();
	return $id;
}