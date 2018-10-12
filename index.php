<?php 


if(isset ($_GET['action'])){
	if($_GET['action'] == 'getPost'){
		
		require_once('Controller/postController.php');
		
		$article = getPost();
		require_once('View/header.php');
		require_once('View/frontEnd/postView.php');
		require_once('View/footer.php');
	}

	else if($_GET['action'] == 'panel'){
		
		require_once('Controller/userController.php');
		
		$username = $_POST['username'];
		$password = $_POST['password'];
		$user = signIn($username, $password);
		
		if($user == false){
			echo 'erreur d\'identifiant on a recu un false';
		}
		else if(isset($user))
		{
			session_start();
			$_SESSION['username'] = $user->getUsername();
			$_SESSION['role'] = $user->getRole();
			
			if(isset($_SESSION) && $_SESSION['role'] == '0')
			{
				require_once('View/header.php');
				require_once('View/backEnd/viewPanelAdmin.php');
				require_once('View/footer.php');
			}
			else if(isset($_SESSION) && $_SESSION['role'] == '1')
			{
				require_once('View/backEnd/viewPanelMember.php');
			}
			else
			{
				echo 'erreur';
			}
		}
	}
}

else {
	require_once('View/frontEnd/homeTemplate.php');
}