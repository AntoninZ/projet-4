<?php ob_start(); ?>
<section class="viewListPost">
	<article>
		<table>
			<thead>
				<tr>
					<th>ID</th>
					<th>Titre</th>
					<th>Date</th>
					<th>Status</th>
					<th>Modifier</th>
				</tr>
			</thead>
			
			<tbody>
				<?php foreach ($article as $object) { ?>
		
				<tr>
					<td><?= $object->getId(); ?></td>
					<td><a href="?action=panel&amp;function=edit&amp;id=<?= $object->getId(); ?>"><?= $object->getTitle(); ?></a></td>
					<td><?= $object->getDate(); ?></td>
					<td><?= $object->getStatus(); ?></td>
					<td class="editPost"><a title="Modifier" href="?action=panel&amp;function=edit&amp;id=<?= $object->getId(); ?>"><i class="fas fa-edit"></i></a></td>
				</tr>
				
				<?php } ?>
			</tbody>
		</table>
	</article>
</section>

<?php $content = ob_get_clean(); ?>