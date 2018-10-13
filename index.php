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
			require_once('View/header.php');
			
			
			// ADMIN DASHBOARD
			if($_SESSION['role'] == 'admin')
			{	
				
				if(isset($_GET['function']))
				{
					
					if($_GET['function'] == 'dashboard')
					{
						require_once('View/backend/viewAdminBoard.php');
						
					}
					
					else if($_GET['function'] == 'listPost')
					{
						//Liste des articles
						require_once('Controller/postController.php');
						$article = getList();
						require_once('View/backEnd/viewListPost.php');						
					}
					else if($_GET['function'] == 'add')
					{
						require_once('Controller/postController.php');
						$id = lastPostId();
						require_once('View/backend/viewAddPost.php');
							
						if(isset($_GET['new']))
						{
							$article = addPost();
							
						// Changer nom variable test
						// Au lieu de récupérer le getPost autant récupérer l'objet et l'insérer dans le contenu sans se soucier de la BDD qui sera identique en terme de contenu !
							
							require_once('View/backend/viewUpdatePost.php');
						}
					}
					else if($_GET['function'] == 'edit')
						{
							require_once('Controller/postController.php');
							if(isset($_GET['update']))
							{
								$article = updatePost();
							}
							$article = getPost();
							require_once('View/backend/viewUpdatePost.php');
						}
						
					// VIEW THE LIST OF COMMENTS TO MODERATE THEM
					else if($_GET['function'] == 'moderate')
					{
						require_once('View/backEnd/viewListComment.php');
					}
					
					require_once('View/backEnd/viewPanelAdmin.php');
				}
			}
			
			
			// MEMBER DASHBOARD
			else if($_SESSION['role'] == 'member')
			{
				require_once('View/backEnd/viewPanelMember.php');
			}
			
			require_once('View/footer.php');
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
			}
		}
	}
}
else
{
	require_once('View/frontEnd/homeTemplate.php');
}