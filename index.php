<?php 
session_start();
if(isset ($_GET['action'])){
	
	// ===========
	//  VIEW POST
	// ===========
	
	if($_GET['action'] == 'getPost'){
		
		require_once('View/header.php');
		
		require_once('Controller/postController.php');
		$article = getPost();

		require_once('View/frontEnd/postView.php');
		require_once('View/footer.php');
	}
	
	// ====================
	//  REGISTER DASHBOARD
	// ====================
	
	// if user is already connect we go to the dashboard, else we connect him before
	
	else if($_GET['action'] == 'panel'){
		if(isset($_SESSION['username']))
		{
			// HEADER
			require_once('View/header.php');
			
			
			// ADMIN DASHBOARD
			if($_SESSION['role'] == 'admin')
			{	
				
				if(isset($_GET['function']))
				{
					
					if($_GET['function'] == 'dashboard') // DASHBOARD (ACCUEIL ADMIN)
					{
						require_once('View/backend/viewAdminBoard.php');	
					}
					
					else if($_GET['function'] == 'listPost') // LIST POSTS
					{	
						require_once('Controller/postController.php');
						$article = getList();
						
						require_once('View/backEnd/viewListPost.php');						
					}
					else if($_GET['function'] == 'listChapter')
					{
						require_once('Controller/chapterController.php');
						$chapters = getListChapter();
						
						require_once('View/backEnd/viewListChapter.php');
					}
					else if($_GET['function'] == 'add') // ADD A NEW POST
					{
						require_once('Controller/postController.php');
						$id = lastPostId(); // Prepare the future id to redirect in viewUpdatePost.php
						
						require_once('Controller/ChapterController.php');
						$chapters = getListChapter(); // Prepare the select for our form with a list of chapter
						
						require_once('View/backend/viewAddPost.php');
						
						if(isset($_GET['new'])) // action of submit button
						{	
							$article = addPost();
							require_once('View/backend/viewUpdatePost.php'); // redirect client on the update of our new post
						}
					}
					else if($_GET['function'] == 'edit') // UPDATE A POST
					{
						require_once('Controller/postController.php');
						
						require_once('Controller/ChapterController.php');
						$chapters = getListChapter(); // Prepare the select for our form with a list of chapter
						
						if(isset($_GET['update'])) // action of submit button
						{
							$article = updatePost();	
						}

						$article = getPost();
							
						require_once('View/backend/viewUpdatePost.php');
							
						if(isset($_GET['delete']))
						{
							$article = deletePost();
								
							$article = getList();
							require_once('View/backend/viewListPost.php');
						}
					}
						
					// VIEW THE LIST OF COMMENTS WHO NEED TO BE MODERATE
					else if($_GET['function'] == 'moderate')
					{
						require_once('View/backEnd/viewListComment.php');
					}
					// VIEW THE LIST OF MEMBERS
					else if($_GET['function'] == 'members')
					{
						require_once('Controller/userController.php');
						$users = getList();
						
						require_once('View/backEnd/viewListMembers.php');
					}
				
					require_once('View/backEnd/viewPanelAdmin.php');
				}	
					
			}
			
			
			// MEMBER DASHBOARD
			else if($_SESSION['role'] == 'member')
			{
				require_once('View/backEnd/viewPanelMember.php');
				// FOOTER
			require_once('View/footer.php');
			}
			
		}

		// SINGIN
		else
		{
			require_once('Controller/userController.php');
		
			$username = $_POST['username'];
			$password = $_POST['password'];
			$user = signIn($username, $password);
		
			if($user == false)
			{
				echo 'erreur d\'identifiant on a recu un false';
			}
			else if(isset($user))
			{
			$_SESSION['username'] = $user->getUsername();
			$_SESSION['role'] = $user->getRole();
			session_start();
			}
		}
	}
}
else
{
	require_once('View/frontEnd/homeTemplate.php');
}