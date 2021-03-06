<?php
try {
	if(isset($_SESSION))
	{
		if($_SESSION['role'] == 'Administrateur')
		{
			ob_start(); ?>

			<section class="viewPost">
				<article>
					<form method="post" action="?function=edit&new&id=<?= $article->getId(); ?>">
						<label for="title" class="nolabel">Titre</label>
						<input type="text" id="title" name="title" placeholder="Titre de l'article"></input>
						
						<label for="content" class="nolabel">Contenu de l'article</label>
						<textarea id="textEditor" name="content"></textarea>
						
						<label for="idChapter">Chapitre :</label>
						<select id="idChapter" name="idChapter">
						<?php foreach ($chapters as $object) { ?>
							<option value="<?= $object->getId(); ?>"><?= $object->getName(); ?></option>
						<?php }?>
						</select>
						
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
catch( Exception $e){
	echo 'Erreur :' .$e->getMessage();
		require_once('../viewError.php');
}