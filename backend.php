<?php
session_start();

// HEADER
require_once('View/header.php');

// SIGNOUT
if(isset($_GET['signOut']))
{
	$_SESSION = array();
	session_unset();
	session_destroy();
}

if(isset($_GET['signIn']))
{
	try {
		require_once('Controller/userController.php');

		$user = getUserLogin();
		
		$_SESSION['username'] = $user->getUsername();
		$_SESSION['role'] = $user->getRole();
		$notification = "Bonjour ". $_SESSION['username'];
	}
	catch(Exception $e)
	{
		$message = $e->getMessage();
		
	}	
}

// USER DISCONNECTED
if(isset($_SESSION['username']) == FALSE)
{
	require_once('View/backEnd/viewConnexion.php');
}
// USER CONNECTED
else if(isset($_SESSION['username']))
{
	// ADMIN DASHBOARD
	try{
		if($_SESSION['role'] == 'Administrateur')
		{	
			if(isset($_GET['function']))
			{	
				try{
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
							$notification = 'Article mis à jour.';
						}
						if(isset($_GET['new'])) // action of submit button
						{	
							$article = addPost();
							$notification = 'Article ajouté.';
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
							$notification = 'Chapitre mis à jour.';
						}
						else if(isset($_GET['new']))
						{
							$chapter = addChapter();
							$notification = 'Chapitre ajouté.';
						}
						
						$chapter = getChapter();
						require_once('View/backEnd/viewUpdateChapter.php');
					}
					
					// LIST OF COMMENTS
					else if($_GET['function'] == 'moderate')
					{
						require_once('Controller/commentController.php');
						
						if(isset($_GET['delete']))
						{
							deleteComment();
						}
						else if(isset($_GET['validate']))
						{
							validateComment();
						}
						
						$comments = getListComment();

						require_once('View/backEnd/viewListComment.php');
						
					}
					
					// LIST OF MEMBERS
					else if($_GET['function'] == 'members')
					{		
						require_once('Controller/userController.php');
						
						if(isset($_GET['deleteUser']))
						{
							$user = deleteUser();
						}
						
						$users = getUserList();
						
						require_once('View/backEnd/viewListMembers.php');
					}	
					else if($_GET['function'] == 'editUser')
					{
						require_once('Controller/userController.php');		
							
						if(isset($_GET['update']))
						{
							$user = updateUser();
							$notification = 'Utilisateur mis à jour.';

						}
						
						$user = getUser();
						require_once('View/backEnd/viewUpdateUser.php');
					}
					else
					{
						throw new Exception('La page demandé n\'existe pas.');
					}
				}
				catch( Exception $e)
				{
					$message = $e->getMessage();
				}
				
			}
			
			// DASHBOARD (HOMEPAGE ADMIN)
			else 
			{
				require_once('View/backend/viewAdminBoard.php');
			}
			
			// TEMPLATE ADMIN VIEW
			require_once('View/backEnd/viewPanelAdmin.php'); 	
		}
		else
		{
			throw new Exception('Vous n\'avez pas les droits nécessaires pour consulter cette page');
		}
	
	}
	catch( Exception $e)
	{
		echo 'Erreur :' .$e->getMessage();
		require_once('../viewError.php');
	}
}

//FOOTER
require_once('View/footer.php');