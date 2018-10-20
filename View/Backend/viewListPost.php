<?php
try {
	if(isset($_SESSION))
	{
		if($_SESSION['role'] == 'admin')
		{
			ob_start(); ?>
			<section class="viewList">
				<header>
					<h2>Section : Article</h2>
				</header>
				<article>
					<a href="?action=panel&function=add"><button class="buttonAdd">Créer un article</button></a>
					
					<table>
						<thead>
							<tr>
								<th>Titre</th>
								<th>Date</th>
								<th>Modifier</th>
								<th>Supprimer</th>
							</tr>
						</thead>
						
						<tbody>
							<?php foreach ($article as $object) { ?>
					
							<tr>
									
									<td><a href="?function=edit&amp;id=<?= $object->getId(); ?>"><?= $object->getTitle(); ?></a></td>
									<td><?= date('d/m/Y', strtotime($object->getDate())); ?></td>
									<td><a title="Modifier l'article" href="?function=edit&amp;id=<?= $object->getId(); ?>"><i class="fas fa-edit"></i></a></td>
									<td><a title="Supprimer l'article" href="?function=listPost&amp;delete&amp;id=<?= $object->getId(); ?>"><i class="fas fa-trash-alt"></a></i></td>
							</tr>
							
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