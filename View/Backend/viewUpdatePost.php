<?php 
try {
	if(isset($_SESSION))
	{
		if($_SESSION['role'] == 'Administrateur')
		{
			ob_start(); ?>

			<section class="viewPost">
				<article>
					<form method="post" action="?function=edit&id=<?= $article->getId(); ?>&update">
						<label for="title" class="nolabel" placeholder="Titre de l'article">Titre</label>
						<input type="text" id="title" name="title" value="<?= $article->getTitle(); ?>"></input>
						
						<label for="content" class="nolabel">Contenu de l'article</label>
						<textarea id="textEditor" name="content"><?= $article->getContent(); ?></textarea>
						<label for="idChapter">Chapitre :</label>
						
						<select id="idChapter" name="idChapter">
							<option selected="selected" value="<?= $article->getIdChapter(); ?>"><?= $chapter->getName(); ?></option>
							<option value="" disabled></option>
						<?php foreach ($chapters as $object) { ?>
							<option value="<?= $object->getId(); ?>"><?= $object->getName(); ?></option>
						<?php }?>
						</select>
						
						<label for="date" class="nolabel">Date</label><input type="text" readonly="readonly" id="date" name="date" value="<?= $article->getDate(); ?>"></input>
						
						<button type="submit">Valider</button>
					</form>
				</article>
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
catch( Exception $e)
{
	echo 'Erreur :' .$e->getMessage();
	require_once('../viewError.php');
}
