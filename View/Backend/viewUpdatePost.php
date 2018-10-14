<?php ob_start(); ?>

<section class="viewPost">
	<article>
		<form method="post" action="?action=panel&function=edit&id=<?= $article->getId(); ?>&update">
			<label for="title" class="nolabel" placeholder="Titre de l'article">Titre</label>
			<input type="text" id="title" name="title" value="<?= $article->getTitle(); ?>"></input>
			
			<label for="content" class="nolabel">Contenu de l'article</label>
			<textarea id="textEditor" name="content"><?= $article->getContent(); ?></textarea>
			<label for="idChapter">Chapitre :</label>
			
			<select id="idChapter" name="idChapter">
				<option selected="selected" value="<?= $article->getIdChapter(); ?>">Add name of chapter</option>
			<?php foreach ($chapters as $object) { ?>
				<option value="<?= $object->getId(); ?>"><?= $object->getName(); ?></option>
			<?php }?>
			</select>
			<br />
			<label for="status">Action :</label>
			<select id="status" name="status">
				<option value="<?= $article->getStatus(); ?>"><?= $article->getStatus(); ?></option>
				<option value="publié">Publier</option>
				<option value="brouillon">Brouillon</option>
			</select>
			
			
			<label for="date" class="nolabel">Date</label><input type="text" readonly="readonly" id="date" name="date" value="<?= $article->getDate(); ?>"></input>
			
			<button type="submit">Valider</button>
		</form>
		<a href="?action=panel&function=edit&id=<?= $article->getId(); ?>&delete">Supprimer l'article</a>
	</article>
</section>

<?php $content = ob_get_clean(); ?>