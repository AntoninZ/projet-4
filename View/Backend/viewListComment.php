<?php ob_start(); ?>
<section class="viewList">
	<header>
		<h2>Section : Commentaire</h2>
	</header>
	<article>
		
		<table>
			<thead>
				<tr>
					<th>Commentaire</th>
					<th>Auteur</th>
					<th>Modifier</th>
					<th>Supprimer</th>
				</tr>
			</thead>
			
			<tbody>
				<?php foreach ($comments as $object) { ?>
		
				<tr>
						<td><a href="?function=editComment&amp;id=<?= $object->getId(); ?>"><?= $object->getContent(); ?></a></td>
						<td><a title="Modifier l'article" href="?function=editComment&amp;id=<?= $object->getId(); ?>"><i class="fas fa-edit"></i></a></td>
						<td><a title="Supprimer l'article" href="?function=listComment&amp;delete&amp;id=<?= $object->getId(); ?>"><i class="fas fa-trash-alt"></a></i></td>
				</tr>
				
				<?php } ?>
			</tbody>
		</table>
	</article>
</section>

<?php $content = ob_get_clean(); ?>