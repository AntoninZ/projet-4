<?php
try {
	if(isset($_SESSION))
	{
		if($_SESSION['role'] == 'Administrateur')
		{
			ob_start(); ?>

			<section class="viewAdminBoard">
				<h2>Bonjour <?= $_SESSION['username']; ?></h2>
				<hr />
				
				<h3>Liste des articles</h3>
				<p>Visionner l'ensemble des articles, créer un nouvel article, modifier ou supprimer un article existant.</p>
				
				<h3>Liste des chapitres</h3>
				<p>Visionner l'ensemble des chapitres, créer un nouveau chapitre, modifier ou supprimer un chapitre existant.<br />
				Les chapitres sont visibles dans le menu du blog ainsi que les articles associés.</p>
				
				<h3>Gérer les commentaires</h3>
				<p>Visionner l'ensemble des commentaires non-vérifiés ou signalés par les lecteurs. Valider ou supprimer un commentaire.<br />
				La liste des commentaires affichera en priorité les commentaires les plus signalés.<br />
				Les commentaires validés seront visibles uniquement sur la page de l'article associé pour simplifier la modération.</p>
				
				<h3>Gérer les membres</h3>
				<p>Visionner l'ensemble des membres inscrits. Modifier le rôle d'un membre ou supprimer un compte.</p>
				
				<h3>Se déconnecter</h3>
				<p>Quitter et fermer la session d'administrateur.</p>
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