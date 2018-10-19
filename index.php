<?php 

session_start();


require_once('View/header.php');

if(isset($_GET['page'])){
	
	// ===========
	//  VIEW POST
	// ===========
	
	if($_GET['page'] == 'postView'){
		require_once('Controller/commentController.php');
		
		if(isset($_GET['report']))
		{
			$comment = getComment();
			ReportComment($comment);
		}
		else if(isset($_GET['addComment']))
		{
			$comment = addComment();
		}
		
		require_once('Controller/PostController.php');

		require_once('Controller/NavigationController.php');
		
		$list = getNavigation();
		
		$article = getPost();
		$comments = getListCommentPost();
		require_once('View/frontEnd/postView.php');
	
		
	}
}

// HOMEPAGE
else {
	require_once('View/frontend/viewHomepage.php');
}

require_once('View/footer.php');