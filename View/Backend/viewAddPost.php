<?php ob_start(); ?>

<section>
	<article>
		<form method="post" action="?action=panel&function=add&create">
			<label for="title">Titre</label>
			<input type="text" id="title" name="title"></input>
			
			<label for="content">Contenu de l'article</label>
			<textarea id="textEditor" name="content"></textarea>
			
			
		</form>
	</article>
</section>

<?php $content = ob_get_clean(); ?>