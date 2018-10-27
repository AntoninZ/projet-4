<?php
try {
	if(isset($_SESSION))
	{
		if($_SESSION['role'] == 'Administrateur')
		{
			ob_start(); ?>

			<section class="viewPost">
				<article>
					<form method="post" action="?function=editUser&id=<?= $user->getId(); ?>&update">
						
						<label for="username">Pseudo :</label>
						<input type="text" id="username" name="username" value="<?= $user->getUsername(); ?>">
						
						<label for="role">Rôle de l'utilisateur :</label>
						<select id="role" name="role">
							<option value="<?= $user->getRole() ?>"><?= $user->getRole(); ?></option>
							<option disabled></option>
							<option value="Administrateur">Administrateur</option>
							<option value="Lecteur">Lecteur</option>
						</select>
						
						<button type="submit">Valider</button>
					</form>
				</article>
			</section>

			<?php $content = ob_get_clean(); 

		}
		else {
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