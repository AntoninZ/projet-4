<?php
try {
	if(isset($_SESSION))
	{
		if($_SESSION['role'] == 'Administrateur')
		{
?>
			<body class="panel-admin">
				<header>
					<h1><a href="index.php">Jean Forteroche - <span>Un billet simple pour l'alaska</span></a></h1>
					<h2>Admistration<?= $title; ?></h2>
				</header>
				<span class="navBackground"></span>
				<nav>
					<div>
						<h2>Accès rapide</h2>
						<ul>
							<li>
								<a href="?">
									<i class="fas fa-home"></i>
									<p>Tableau de bord</p>
								</a>
							</li>
							<li>
								<a href="?function=listPost">
									<i class="fas fa-archive"></i>
									<p>Liste des articles</p>
								</a>
							</li>
							<li>
								<a href="?function=listChapter">
									<i class="fas fa-list-ol"></i>
									<p>Liste des chapitres</p>
								</a>
							</li>
							<li>
								<a href="?function=moderate">
									<i class="fas fa-comments"></i>
									<p>Gérer les commentaires</p>
								</a>
							</li>
							<li>
								<a href="?function=members">
									<i class="fas fa-users-cog"></i>
									<p>Gérer les membres</p>
								</a>
							</li>
							<li>
								<a href="?signOut">
									<i class="fas fa-sign-out-alt"></i>
									<p>Se déconnecter</p>
								</a>
							</li>
						</ul>
						
						<?php if(!empty($notification)){ ?>
							
							<div id="notification">
								<h3>Notification</h3>
								<p><?= $notification ?></p>
							</div>
							
						<?php } ?>
						
					</div>
				</nav>
				
				
				
				<?php 
				echo $content;
		}
		else
		{
			throw new Exception('Vous n\'avez pas les droits nécessaires pour consulter cette page');
		}
	}
	else
	{
		throw new Exception('Vous devez être connecté en tant qu\'administrateur pour voir ce contenu');
	}
}
catch( Exception $e)
{
	echo 'Erreur :' .$e->getMessage();
	require_once('../viewError.php');
}