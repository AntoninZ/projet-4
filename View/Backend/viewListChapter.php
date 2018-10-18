<?php ob_start(); ?>
<section class="viewList">
	<header>
		<h2>Section : Chapitre</h2>
	</header>
	<article>
		<a href="?function=addChapter"><button class="buttonAdd">Créer un chapitre</button></a>
		
		<table>
			<thead>
				<tr>
					<th>Name</th>
					<th>Modifier</th>
					<th>Supprimer</th>
				</tr>
			</thead>
			
			<tbody>
				<?php foreach ($chapters as $object) { ?>
		
				<tr>
						<td><a href="?function=editChapter&amp;id=<?= $object->getId(); ?>"><?= $object->getName(); ?></a></td>
						<td><a title="Modifier l'article" href="?function=editChapter&amp;id=<?= $object->getId(); ?>"><i class="fas fa-edit"></i></a></td>
						<td><a title="Supprimer l'article" href="?function=listChapter&amp;delete&amp;id=<?= $object->getId(); ?>"><i class="fas fa-trash-alt"></a></i></td>
				</tr>
				
				<?php } ?>
			</tbody>
		</table>
	</article>
</section>

<?php $content = ob_get_clean(); ?>