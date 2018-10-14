<?php ob_start(); ?>
<section class="viewList">
	<header>
		<h2>Section : Chapitre</h2>
	</header>
	<article>
		<a href="?action=panel&function=add"><button class="buttonAdd">Créer un chapitre</button></a>
		
		<table>
			<thead>
				<tr>
					<th>ID</th>
					<th>Name</th>
					<th>Modifier</th>
				</tr>
			</thead>
			
			<tbody>
				<?php foreach ($chapters as $object) { ?>
		
				<tr>
						<td><?= $object->getId(); ?></td>
						<td><a href="?action=panel&amp;function=edit&amp;id=<?= $object->getId(); ?>"><?= $object->getName(); ?></a></td>
						<td><a title="Modifier l'article" href="?action=panel&amp;function=edit&amp;id=<?= $object->getId(); ?>"><i class="fas fa-edit"></i></a></td>
				</tr>
				
				<?php } ?>
			</tbody>
		</table>
	</article>
</section>

<?php $content = ob_get_clean(); ?>