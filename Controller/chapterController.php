<?php
require_once('Model/ChapterManager.php');

function getChapter() {		
	$db = new PDO('mysql:host=localhost;dbname=projet4;charset=utf8', 'root', '');
	$manager = new ChapterManager($db);		
	
	$id = $_GET['id'];

	$chapter = $manager->get($id);
	return $chapter;
}

function getChapterNameById($id) {
	$db = new PDO('mysql:host=localhost;dbname=projet4;charset=utf8', 'root', '');
	$manager = new ChapterManager($db);		

	$chapter = $manager->get($id);
	
	$donnees = $chapter->getName();
	return $donnees;
}

function getChapterInfo($idChapter) {
	$db = new PDO('mysql:host=localhost;dbname=projet4;charset=utf8', 'root', '');
	$manager = new ChapterManager($db);		
	
	$id = $idChapter;

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
		'name' => $_POST['name'],
	]);
	
	$db = new PDO('mysql:host=localhost;dbname=projet4;charset=utf8', 'root', '');
	$manager = new ChapterManager($db);
	$manager->add($chapter);
}

function ChapterCount() {
	
	$db = new PDO('mysql:host=localhost;dbname=projet4;charset=utf8', 'root', '');
	$manager = new ChapterManager($db);
	$ChapterCount = $manager->getCountChapter();
	
	return $ChapterCount;
}

function lastChapterId(){
	$db = new PDO('mysql:host=localhost;dbname=projet4;charset=utf8', 'root', '');
	$manager = new ChapterManager($db);		
	
	$id = $manager->getLastChapterId();
	return $id;
}

function deleteChapter() {
	$chapterDelete = new Chapter([
		'id' => $_GET['id']
	]);
	
	$db = new PDO('mysql:host=localhost;dbname=projet4;charset=utf8', 'root', '');
	$manager = new chapterManager($db);
	$chapter = $manager->delete($chapterDelete);
}