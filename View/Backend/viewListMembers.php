<?php ob_start(); ?>
<section class="viewList">
	<header>
		<h2>Section : Membre</h2>
	</header>
	<article>
		<table>
			<thead>
				<tr>
					<th>Pseudo</th>
					<th>Role</th>
					<th>Modifier</th>
					<th>Supprimer</th>
				</tr>
			</thead>
			
			<tbody>
				<?php foreach ($users as $object) { ?>
		
				<tr>
					<td><a href="?function=editUser&amp;id=<?= $object->getId(); ?>"><?= $object->getUsername(); ?></a></td>
					<td><?= $object->getRole(); ?></td>
					<td class="editPost"><a title="Modifier le membre" href="?function=editUser&amp;id=<?= $object->getId(); ?>"><i class="fas fa-edit"></i></a></td>
					<td class="editPost"><a title="Supprimer le membre" href="?function=deleteUser&amp;id=<?= $object->getId(); ?>"><i class="fas fa-trash-alt"></i></a></td>
				</tr>
				
				<?php } ?>
			</tbody>
		</table>
	</article>
</section>

<?php $content = ob_get_clean(); ?>