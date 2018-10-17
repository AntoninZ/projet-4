<?php ob_start(); ?>
<section class="viewList">
	<article>
		<table>
			<thead>
				<tr>
					<th>ID</th>
					<th>Pseudo</th>
					<th>Role</th>
					<th>Modifier</th>
				</tr>
			</thead>
			
			<tbody>
				<?php foreach ($users as $object) { ?>
		
				<tr>
					<td><?= $object->getId(); ?></td>
					<td><a href="?function=editUser&amp;id=<?= $object->getId(); ?>"><?= $object->getUsername(); ?></a></td>
					<td><?= $object->getRole(); ?></td>
					<td class="editPost"><a title="Modifier" href="?function=editUser&amp;id=<?= $object->getId(); ?>"><i class="fas fa-edit"></i></a></td>
				</tr>
				
				<?php } ?>
			</tbody>
		</table>
	</article>
</section>

<?php $content = ob_get_clean(); ?>