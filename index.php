<?php 
if(isset($_SESSION['username']))
{
	session_start();
}

require_once('View/header.php');

if(isset($_GET['page'])){
	
	// ===========
	//  VIEW POST
	// ===========
	
	if($_GET['page'] == 'postView'){
		require_once('Controller/postController.php');
		$article = getPost();

		require_once('View/frontEnd/postView.php');
		

	}
}

// HOMEPAGE
else {
	require_once('View/frontend/viewHomepage.php');
}

require_once('View/footer.php');