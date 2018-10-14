<?php ob_start(); ?>

<section class="viewPost">
	<article>
		<form method="post" action="?action=panel&function=add&new&id=<?= $id ?>">
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
			<br />
			<label for="status">Action :</label>
			<select id="status" name="status">
				<option value="publié">Publier</option>
				<option value="brouillon">Sauvegarder</option>
			</select>
			
			<button type="submit">Ajouter</submit>
		</form>
	</article>
</section>

<?php $content = ob_get_clean(); ?>