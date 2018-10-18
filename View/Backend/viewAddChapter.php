<?php ob_start(); ?>

<section class="viewPost">
	<article>
		<form method="post" action="?function=editChapter&new&id=<?= $chapter->getId(); ?>">
			<label for="name">Nom du chapitre</label>
			<input type="text" id="name" name="name"></input>
			
			<button type="submit">Ajouter</submit>
		</form>
	</article>
</section>

<?php $content = ob_get_clean(); ?>