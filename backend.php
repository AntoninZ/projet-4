<?php
session_start();

// HEADER
require_once('View/header.php');
// USER DISCONNECTED
if(isset($_SESSION['username']) == FALSE)
{
	require_once('View/backEnd/viewConnexion.php');
	
	if(isset($_GET['signIn']))
	{
		require_once('Controller/userController.php');
	
		$user = getUserLogin();
		
		session_start();
		$_SESSION['username'] = $user->getUsername();
		$_SESSION['role'] = $user->getRole();
		
		
	}
	else if(isset($_GET['signUp']))
	{
		require_once('Controller/userController.php');
		$newUser = addUser();
	}
	
	
}
// USER CONNECTED
if(isset($_SESSION['username']))
{
	// ADMIN DASHBOARD
	if($_SESSION['role'] == 'admin')
	{	
		if(isset($_GET['function']))
		{	
			// LIST OF POSTS
			if($_GET['function'] == 'listPost')
			{	
				require_once('Controller/postController.php');
				require_once('Controller/ChapterController.php');
				
				if(isset($_GET['delete']))
				{
					$article = deletePost();
				}
				
				$article = getList();
				require_once('View/backEnd/viewListPost.php');						
			}
			
			// ADD A NEW POST
			else if($_GET['function'] == 'add')
			{
				require_once('Controller/postController.php');
				$article = lastPostId(); // Prepare the future id to redirect in viewUpdatePost.php
				
				require_once('Controller/ChapterController.php');
				$chapters = getListChapter(); // Prepare the select for our form with a list of chapter
				
				require_once('View/backend/viewAddPost.php');
				
			}
			
			// UPDATE A POST
			else if($_GET['function'] == 'edit') 
			{
				require_once('Controller/postController.php');
				
				require_once('Controller/ChapterController.php');
				$chapters = getListChapter(); // Prepare the select for our form with a list of chapter
				
				if(isset($_GET['update'])) // action of submit button
				{
					$article = updatePost();
				}
				if(isset($_GET['new'])) // action of submit button
				{	
					$article = addPost();
				}
				
				
				$article = getPost();
				$idChapter = $article->getIdChapter();
				$chapter = getChapterInfo($idChapter);
				require_once('View/backend/viewUpdatePost.php');
				
				
			}
			
			// LIST OF CHAPTERS
			else if($_GET['function'] == 'listChapter')
			{
				require_once('Controller/chapterController.php');
				
				if(isset($_GET['delete']))
				{
					deleteChapter();
				}
				
				$chapters = getListChapter();
				require_once('View/backEnd/viewListChapter.php');
			}
			// ADD CHAPTER
			else if($_GET['function'] == 'addChapter')
			{
				require_once('Controller/ChapterController.php');
				$chapter = lastChapterId(); // Prepare the future id to redirect in viewUpdatePost.php
				require_once('View/backEnd/viewAddChapter.php');
			}
			// UPDATE CHAPTER
			else if($_GET['function'] == 'editChapter')
			{
				require_once('Controller/chapterController.php');
				
				if(isset($_GET['update']))
				{
					$chapter = updateChapter();
				}
				else if(isset($_GET['new']))
				{
					$chapter = addChapter();
				}
				
				$chapter = getChapter();
				require_once('View/backEnd/viewUpdateChapter.php');
			}
			
			// LIST OF COMMENTS
			else if($_GET['function'] == 'moderate')
			{
				require_once('Controller/commentController.php');
				
				if(isset($_GET['delete'])
				{
					deleteComment();
				}
				
				require_once('View/backEnd/viewListComment.php');
			}
			
			// LIST OF MEMBERS
			else if($_GET['function'] == 'members')
			{
				require_once('Controller/userController.php');
				$users = getUserList();
				
				require_once('View/backEnd/viewListMembers.php');
			}	
			else if($_GET['function'] == 'editUser')
			{
				require_once('Controller/userController.php');		
					
				if(isset($_GET['update']))
				{
					$user = updateUser();

				}
				
				$user = getUserInfo();
				require_once('View/backEnd/viewUpdateUser.php');
			}
		}
		
		// DASHBOARD (HOMEPAGE ADMIN)
		else 
		{
			require_once('View/backend/viewAdminBoard.php');
		}
		
		require_once('View/backEnd/viewPanelAdmin.php'); // TEMPLATE	
	}
	
	// MEMBER DASHBOARD
	else if($_SESSION['role'] == 'member')
	{
		require_once('View/backEnd/viewPanelMember.php');
	}
}


//FOOTER
require_once('View/footer.php');