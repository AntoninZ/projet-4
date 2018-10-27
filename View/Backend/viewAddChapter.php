<?php
try {
	if(isset($_SESSION))
	{
		if($_SESSION['role'] == 'Administrateur')
		{
			ob_start(); ?>

			<section class="viewPost">
				<article>
					<form method="post" action="?function=editChapter&new&id=<?= $chapter->getId(); ?>">
						<label for="name">Nom du chapitre</label>
						<input type="text" id="name" name="name">
						
						<button type="submit">Ajouter</button>
					</form>
				</article>
			</section>

			<?php
			$content = ob_get_clean(); 

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