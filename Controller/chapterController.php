<?php
require_once $_SERVER['DOCUMENT_ROOT'].('/Controller/connectController.php');
require_once $_SERVER['DOCUMENT_ROOT'].('/Model/chapterManager.php');


function getChapter() {		
	$db = connect();
	$manager = new ChapterManager($db);		
	
	$id = $_GET['id'];

	$chapter = $manager->get($id);
	return $chapter;
}

function getChapterNameById($id) {
	$db = connect();
	$manager = new ChapterManager($db);		

	$chapter = $manager->get($id);
	
	$donnees = $chapter->getName();
	return $donnees;
}

function getChapterInfo($idChapter) {
	$db = connect();
	$manager = new ChapterManager($db);		
	
	$id = $idChapter;

	$chapter = $manager->get($id);
	return $chapter;
}

function getListChapter() {
	$db = connect();
	$manager = new ChapterManager($db);
	$chapters = $manager->getListChapter();
	return $chapters;
}

function updateChapter() {
	$chapterUpdate = new Chapter([
		'id' => $_GET['id'],
		'name' => $_POST['name'],
	]);
	
	$db = connect();
	$manager = new chapterManager($db);
	$chapter = $manager->update($chapterUpdate);
}

function addChapter() {
	$chapter = new Chapter([
		'id' => $_GET['id'],
		'name' => $_POST['name']
	]);
	
	$db = connect();
	$manager = new ChapterManager($db);
	$manager->add($chapter);
}

function ChapterCount() {
	
	$db = connect();
	$manager = new ChapterManager($db);
	$ChapterCount = $manager->getCountChapter();
	
	return $ChapterCount;
}

function lastChapterId(){
	$db = connect();
	$manager = new ChapterManager($db);		
	
	$id = $manager->getLastChapterId();
	return $id;
}

function deleteChapter() {
	$chapterDelete = new Chapter([
		'id' => $_GET['id']
	]);
	
	$db = connect();
	$manager = new chapterManager($db);
	$chapter = $manager->delete($chapterDelete);
}