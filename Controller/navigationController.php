<?php
require_once('Model/postManager.php');
require_once('Model/ChapterManager.php');

function getNavigation()
{
	$db = new PDO('mysql:host=localhost;dbname=projet4;charset=utf8', 'root', '');
	
	$postManager = new PostManager($db);
	$chapterManager = new ChapterManager($db);
	
	$countChapter = $chapterManager->getCountChapter();
	
	for($id = 1; $id <= $countChapter; $id++)
	{
		$chapter = $chapterManager->get($id);
		
		$list[$id] = ['chapter' => $chapter->getName(), 'listPosts' => $postManager->getPostByIdChapter($id)];
	}
	
	return $list;
}

