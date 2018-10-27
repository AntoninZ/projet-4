<?php 

ini_set('display_errors',1);

session_start();


require_once $_SERVER['DOCUMENT_ROOT'].('/View/header.php');

if(isset($_GET['page'])){
	
	// View post
	
	try {
		if($_GET['page'] == 'postView' && isset($_GET['id'])){
			
			
			require_once $_SERVER['DOCUMENT_ROOT'].('/Controller/commentController.php');
			
			try {
				if(isset($_GET['report']))
				{
					$comment = getComment();
					ReportComment($comment);
					header('Location: ?page=postView&id='. $_GET['id']);
				}
				else if(isset($_GET['signIn']))
				{
					require_once $_SERVER['DOCUMENT_ROOT'].('/Controller/userController.php');

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
					require_once $_SERVER['DOCUMENT_ROOT'].('/Controller/userController.php');
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
			
			
			require_once $_SERVER['DOCUMENT_ROOT'].('/Controller/postController.php');
			require_once $_SERVER['DOCUMENT_ROOT'].('/Controller/navigationController.php');
			
			$count = CountPost();
			
			try {
				if($_GET['id'] >= 1 && $_GET['id'] <= $count)
				{
					$list = getNavigation();
					$article = getPost();
					$previous = intval($_GET['id']) - 1;
					$next = intval($_GET['id']) + 1;
					
					$comments = getListCommentPost();
					
						
					require_once $_SERVER['DOCUMENT_ROOT'].('/View/Frontend/postView.php');
					require_once $_SERVER['DOCUMENT_ROOT'].('/View/Frontend/viewComment.php');		
				}
				else {
					throw new Exception('Ce billet n\'existe pas !');
				}
			}
			catch(Exception $e) {
				echo 'Erreur : ' . $e->getMessage();
				require_once $_SERVER['DOCUMENT_ROOT'].('/View/viewError.php');
			}
		}
		else if($_GET['page'] == 'legalNotice')
		{
			require_once $_SERVER['DOCUMENT_ROOT'].('/View/Frontend/viewLegalNotice.php');
		}
		else if($_GET['page'] == "contact")
		{
			if(isset($_GET['send'])){
				require_once $_SERVER['DOCUMENT_ROOT'].('/Controller/contactController.php');
				sendMail();
			}
			require_once $_SERVER['DOCUMENT_ROOT'].('/View/Frontend/viewContact.php');
		}
		else
		{
			throw new Exception('La page demandée n\'existe pas.');
		}
	}
	catch(Exception $e) 
	{
		$error = 'Erreur : ' .$e->getMessage();
		require_once $_SERVER['DOCUMENT_ROOT'].('/View/viewError.php');
	}
}

// HOMEPAGE
else {
	require_once $_SERVER['DOCUMENT_ROOT'].('/View/Frontend/viewHomepage.php');
}

require_once $_SERVER['DOCUMENT_ROOT'].('/View/footer.php');