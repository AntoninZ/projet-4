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
					<th>Signalement</th>
					<th>Valider</th>
					<th>Supprimer</th>
				</tr>
			</thead>
			
			<tbody>
				<?php foreach ($comments as $object) { ?>
		
				<tr>
						<td><a href="?function=editComment&amp;id=<?= $object->getId(); ?>"><?= $object->getContent(); ?></a></td>
						<td><?= $object->getReportCount(); ?></td>
						<td><a title="Modifier le commentaire" href="?function=moderate&amp;validate&amp;id=<?= $object->getId(); ?>"><i class="fas fa-check-circle"></i></a></td>
						<td><a title="Supprimer le commentaire" href="?function=moderate&amp;delete&amp;id=<?= $object->getId(); ?>"><i class="fas fa-trash-alt"></a></i></td>
				</tr>
				
				<?php } ?>
			</tbody>
		</table>
	</article>
</section>

<?php $content = ob_get_clean(); ?>