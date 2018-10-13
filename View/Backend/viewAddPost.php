<?php ob_start(); ?>

<section>
	<article>
		<form method="post" action="?action=panel&function=add&new&id=<?= $id ?>">
			<label for="title">Titre</label>
			<input type="text" id="title" name="title"></input>
			
			<label for="content">Contenu de l'article</label>
			<textarea id="textEditor" name="content"></textarea>
			
			<select id="idChapter" name="idChapter">
				<option value="1">Chapitre 1</option>
				<option value="2">Chapitre 2</option>
			</select>
			
			<select id="status" name="status">
				<option value="publié">Publier</option>
				<option value="brouillon">Brouillon</option>
			</select>
			
			<button type="submit">Ajouter</submit>
		</form>
	</article>
</section>

<?php $content = ob_get_clean(); ?>