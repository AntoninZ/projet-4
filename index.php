<?php 
	session_start();


require_once('View/header.php');

if(isset($_GET['page'])){
	
	// View post
	
	try {
		if($_GET['page'] == 'postView' && isset($_GET['id'])){
			require_once('Controller/commentController.php');
			try {
				if(isset($_GET['report']))
				{
					$comment = getComment();
					ReportComment($comment);
					header('Location: ?page=postView&id='. $_GET['id']);
				}
				else if(isset($_GET['signIn']))
				{
					require_once('Controller/userController.php');

					$user = getUserLogin();
					
					$_SESSION['username'] = $user->getUsername();
					$_SESSION['role'] = $user->getRole();
					header('Location: ?page=postView&id='. $_GET['id']);
				}
				else if(isset($_GET['addComment']))
				{
					$comment = addComment();
					header('Location: ?page=postView&id=1');
				}
				else if(isset($_GET['signUp']))
				{
					require_once('Controller/userController.php');
					$newUser = addUser();	
					header('Location: ?page=postView&id='. $_GET['id']);
				}
				else if(isset($_GET['signOut']))
				{
					$_SESSION = array();
					session_unset();
					session_destroy();
				}
			}
			catch(Exception $e)
			{
				$error = 'Erreur: ' .$e->getMessage();
			}
			
			
			require_once('Controller/PostController.php');
			require_once('Controller/NavigationController.php');
			
			$count = CountPost();
			
			try {
				if($_GET['id'] >= 1 && $_GET['id'] <= $count)
				{
					$list = getNavigation();
					$article = getPost();
					$previous = intval($_GET['id']) - 1;
					$next = intval($_GET['id']) + 1;
					
					$comments = getListCommentPost();
					
						
					require_once('View/frontEnd/postView.php');
					require_once('View/frontEnd/viewComment.php');		
				}
				else {
					throw new Exception('Ce billet n\'existe pas !');
				}
			}
			catch(Exception $e) {
				echo 'Erreur : ' . $e->getMessage();
				require_once('View/viewError.php');
			}
		}
		else
		{
			throw new Exception('La page demandé n\'existe pas.');
		}
	}
	catch(Exception $e) 
	{
		echo 'Erreur :' .$e->getMessage();
		require_once('View/viewError.php');
	}
}

// HOMEPAGE
else {
	require_once('View/frontend/viewHomepage.php');
}

require_once('View/footer.php');