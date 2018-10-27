<?php
try {
	if(isset($_SESSION))
	{
		if($_SESSION['role'] == 'Administrateur')
		{
			ob_start(); ?>
			<section class="viewList">
				<article>
					<a href="?function=addChapter" class="createNew"><i class="fas fa-plus"></i> Créer un chapitre.</a>
					
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
									<td><a title="Supprimer l'article" href="?function=listChapter&amp;delete&amp;id=<?= $object->getId(); ?>" onclick="return confirm('Voulez-vous vraiment supprimer ce chapître ?')"><i class="fas fa-trash-alt"></a></i></td>
							</tr>
							
							<?php }
							if(empty($chapters)){ ?>
							
							<td colspan="4" class="emptyMessage"> Il n'y a aucun chapitre.</td>
							
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