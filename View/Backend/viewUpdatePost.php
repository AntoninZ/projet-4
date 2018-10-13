<?php ob_start(); ?>

<section>
	<article>
		<form method="post" action="?action=panel&function=edit&id=<?= $article->getId(); ?>&update">
			<label for="title">Titre</label>
			<input type="text" id="title" name="title" value="<?= $article->getTitle(); ?>"></input>
			
			<label for="content">Contenu de l'article</label>
			<textarea id="textEditor" name="content"><?= $article->getContent(); ?></textarea>
			<input type="text" id="date" name="date" value="<?= $article->getDate(); ?>"></input>
			<input type="text" id="idChapter" name="idChapter" value="<?= $article->getIdChapter(); ?>"></input>
			<input type="text" id="status" name="status" value="<?= $article->getStatus(); ?>"></input>
			<button type="submit">Valider</button>
		</form>
	</article>
</section>

<?php $content = ob_get_clean(); ?>