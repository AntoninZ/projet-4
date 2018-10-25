<?php
require_once $_SERVER['DOCUMENT_ROOT'].('/Model/postManager.php');
require_once $_SERVER['DOCUMENT_ROOT'].('/Model/chapterManager.php');
require_once $_SERVER['DOCUMENT_ROOT'].('/Controller/connectController.php');

function getNavigation()
{
	$db = connect();
	
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

