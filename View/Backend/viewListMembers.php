<?php
try {
	if(isset($_SESSION))
	{
		if($_SESSION['role'] == 'Administrateur')
		{
			ob_start(); ?>
			<section class="viewList">
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
								<td class="editPost"><a title="Supprimer le membre" href="?function=members&amp;id=<?= $object->getId(); ?>&amp;deleteUser" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce membre ?')"><i class="fas fa-trash-alt"></i></a></td>
							</tr>
							
							<?php }
							if(empty($users)){ ?>
							
							<td colspan="4" class="emptyMessage"> Il n'y a aucun membre d'inscrit.</td>
							
							<?php } ?>
						</tbody>
					</table>
				</article>
			</section>

			<?php
			$content = ob_get_clean(); 

		}
		else
		{
			throw new Exception('Vous n\'avez pas les droits nécessaires pour consulter cette page');
		}
	}
	else
	{
		throw new Exception('Vous devez être connecté en tant qu\'administrateur pour voir ce contenu');
	}
}
catch( Exception $e)
{
	echo 'Erreur :' .$e->getMessage();
	require_once('../viewError.php');
}