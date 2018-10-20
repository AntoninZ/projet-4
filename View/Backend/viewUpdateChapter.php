<?php
try {
	if(isset($_SESSION))
	{
		if($_SESSION['role'] == 'admin')
		{
			ob_start(); ?>

			<section class="viewPost">
				<article>
					<form method="post" action="?function=editChapter&id=<?= $chapter->getId(); ?>&update">
						
						<label for="name">Nom du chapitre</label>
						<input type="text" id="name" name="name" value="<?= $chapter->getName(); ?>"></input>
						
						<button type="submit">Valider</button>
					</form>
				</article>
			</section>

			<?php $content = ob_get_clean();

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
catch( Exception $e)
{
	echo 'Erreur :' .$e->getMessage();
	require_once('../viewError.php');
}
