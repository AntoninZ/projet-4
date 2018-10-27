<?php
ini_set('display_errors',1);

session_start();

// HEADER
require_once $_SERVER['DOCUMENT_ROOT'].('/View/header.php');

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
		require_once $_SERVER['DOCUMENT_ROOT'].('/Controller/userController.php');

		$user = getUserLogin();
		
		$_SESSION['username'] = $user->getUsername();
		$_SESSION['role'] = $user->getRole();
		$notification = 'Bonjour ' . $_SESSION['username'];
	}
	catch(Exception $e)
	{
		$message = $e->getMessage();
		
	}	
}

// USER DISCONNECTED
if(isset($_SESSION['username']) == FALSE)
{
	require_once $_SERVER['DOCUMENT_ROOT'].('/View/Backend/viewConnexion.php');
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
						require_once $_SERVER['DOCUMENT_ROOT'].('/Controller/postController.php');
						require_once $_SERVER['DOCUMENT_ROOT'].('/Controller/chapterController.php');
						
						if(isset($_GET['delete']))
						{
							$article = deletePost();
							$notification = 'Article supprimé.';
						}
						
						$title = ' - Liste des articles';
						$article = getList();
						require_once $_SERVER['DOCUMENT_ROOT'].('/View/Backend/viewListPost.php');						
					}
					
					// ADD A NEW POST
					else if($_GET['function'] == 'add')
					{
						require_once $_SERVER['DOCUMENT_ROOT'].('/Controller/postController.php');
						$article = lastPostId(); // Prepare the future id to redirect in viewUpdatePost.php
						
						require_once $_SERVER['DOCUMENT_ROOT'].('/Controller/chapterController.php');
						$chapters = getListChapter(); // Prepare the select for our form with a list of chapter
						
						$title = ' - Nouvel article';
						require_once $_SERVER['DOCUMENT_ROOT'].('/View/Backend/viewAddPost.php');
						
					}
					
					// UPDATE A POST
					else if($_GET['function'] == 'edit') 
					{
						require_once $_SERVER['DOCUMENT_ROOT'].('/Controller/postController.php');
						
						require_once $_SERVER['DOCUMENT_ROOT'].('/Controller/chapterController.php');
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
						$title = ' - Modifier un article';
						require_once $_SERVER['DOCUMENT_ROOT'].('/View/Backend/viewUpdatePost.php');
						
					}
					
					// LIST OF CHAPTERS
					else if($_GET['function'] == 'listChapter')
					{
						require_once $_SERVER['DOCUMENT_ROOT'].('/Controller/chapterController.php');
						
						if(isset($_GET['delete']))
						{
							deleteChapter();
							$notification = 'Chapitre supprimé.';
						}
						
						$chapters = getListChapter();
						$title = ' - Liste des chapitres';
						require_once $_SERVER['DOCUMENT_ROOT'].('/View/Backend/viewListChapter.php');
					}
					// ADD CHAPTER
					else if($_GET['function'] == 'addChapter')
					{
						require_once('Controller/chapterController.php');
						$chapter = lastChapterId(); // Prepare the future id to redirect in viewUpdatePost.php
						$title = ' - Nouveau chapitre';
						require_once $_SERVER['DOCUMENT_ROOT'].('/View/Backend/viewAddChapter.php');
					}
					// UPDATE CHAPTER
					else if($_GET['function'] == 'editChapter')
					{
						require_once $_SERVER['DOCUMENT_ROOT'].('/Controller/chapterController.php');
						
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
						$title = ' - Modifier un chapitre';
						require_once $_SERVER['DOCUMENT_ROOT'].('/View/Backend/viewUpdateChapter.php');
					}
					
					// LIST OF COMMENTS
					else if($_GET['function'] == 'moderate')
					{
						require_once $_SERVER['DOCUMENT_ROOT'].('/Controller/commentController.php');
						
						if(isset($_GET['delete']))
						{
							deleteComment();
							$notification = 'Commentaire supprimé.';
						}
						else if(isset($_GET['validate']))
						{
							validateComment();
							$notification = 'Commentaire validé.';
						}
						
						$comments = getListComment();
						$title = ' - Liste des commentaires';
						require_once $_SERVER['DOCUMENT_ROOT'].('/View/Backend/viewListComment.php');
						
					}
					
					// LIST OF MEMBERS
					else if($_GET['function'] == 'members')
					{		
						require_once $_SERVER['DOCUMENT_ROOT'].('/Controller/userController.php');
						
						if(isset($_GET['deleteUser']))
						{
							$user = deleteUser();
							$notification = 'Membre supprimé';
						}
						
						$users = getUserList();
						$title = ' - Liste des membres';
						require_once $_SERVER['DOCUMENT_ROOT'].('/View/Backend/viewListMembers.php');
					}	
					else if($_GET['function'] == 'editUser')
					{
						require_once $_SERVER['DOCUMENT_ROOT'].('/Controller/userController.php');		
							
						if(isset($_GET['update']))
						{
							$user = updateUser();
							$notification = 'Utilisateur mis à jour.';

						}
						
						$user = getUser();
						$title = ' - Modifier un membre';
						require_once $_SERVER['DOCUMENT_ROOT'].('/View/Backend/viewUpdateUser.php');
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
				$title = ' - Tableau de bord';
				require_once $_SERVER['DOCUMENT_ROOT'].('/View/Backend/viewAdminBoard.php');
			}
			
			// TEMPLATE ADMIN VIEW
			require_once $_SERVER['DOCUMENT_ROOT'].('/View/Backend/viewPanelAdmin.php'); 	
		}
		else
		{
			throw new Exception('Vous n\'avez pas les droits nécessaires pour consulter cette page');
		}
	
	}
	catch( Exception $e)
	{
		echo 'Erreur :' .$e->getMessage();
		require_once $_SERVER['DOCUMENT_ROOT'].('/View/viewError.php');
	}
}

//FOOTER
require_once('View/footer.php');