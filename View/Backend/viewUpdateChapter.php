<?php ob_start(); ?>

<section class="viewPost">
	<article>
		<form method="post" action="?function=editChapter&id=<?= $chapter->getId(); ?>&update">
			
			<label for="name">Nom du chapitre</label>
			<input type="text" id="name" name="name" value="<?= $chapter->getName(); ?>"></input>
			
			<button type="submit">Valider</button>
		</form>
	</article>
</section>

<?php $content = ob_get_clean(); ?>
