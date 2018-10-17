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
	
		$user = getUser();
		
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
			
			// LIST OF CHAPTERS
			else if($_GET['function'] == 'listChapter')
			{
				require_once('Controller/chapterController.php');
				$chapters = getListChapter();
				
				require_once('View/backEnd/viewListChapter.php');
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
				$chapter = getChapter($idChapter);
				require_once('View/backend/viewUpdatePost.php');
				
				
			}
			
			// LIST OF COMMENTS WHO NEED TO BE MODERATE
			else if($_GET['function'] == 'moderate')
			{
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
				$users = 
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