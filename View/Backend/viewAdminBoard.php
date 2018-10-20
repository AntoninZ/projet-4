<?php
try {
	if(isset($_SESSION))
	{
		if($_SESSION['role'] == 'admin')
		{
			ob_start(); ?>

			<section class="viewAdminBoard">
				<h2>Bonjour <?= $_SESSION['username']; ?>, voici les nouvelles du site</h2>
				<hr />
				
				<h3>Commentaires</h3>
				<p>Vous avez ADD NUMBER MODERATE COMMENT commentaires à modérer dont ADD REPORT COMMENT qui nous ont été signalé.</p>
				<a href="">Accéder à la modération</a>
				
				<h3>Articles</h3>
				<p>Vous cumulez ADD NUMBER ARTICLE articles. Souhaitez-vous en écrire un nouveau ?</p>
				<a href="">Ecrire un nouvel article</a>
				
				<h3>Membres</h3>
				<p>Actuellement il y a ADD NUMBER OF ACCOUNT membres inscrits.</p>
				<a href="">Accéder à la gestion des membres</a>
				
				
			</section>

			<?php
			$content = ob_get_clean(); 

		}
		else {
			throw new Exception('Vous n\'avez pas les droits nécessaires pour consulter cette page');
		}
	}
	else
	{
		throw new Exception('Vous devez être connecté en tant qu\'administrateur pour voir ce contenu');
	}
}
catch(Exception $e)
{
	echo 'Erreur :' .$e->getMessage();
	require_once('../viewError.php');
}