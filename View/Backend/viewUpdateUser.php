<?php ob_start(); ?>

<section class="viewPost">
	<article>
		<form method="post" action="?function=editUser&id=<?= $user->getId(); ?>&update">
			
			<label for="username">Pseudo :</label>
			<input type="text" id="username" name="username" value="<?= $user->getUsername(); ?>"></input>
			
			<label for="role">Rôle de l'utilisateur :</label>
			<select id="role" name="role">
				<option value="<?= $user->getRole() ?>"><?= $user->getRole(); ?></option>
				<option disabled></option>
				<option value="admin">Administrateur</option>
				<option value="member">Lecteur</option>
			</select>
			
			<button type="submit">Valider</button>
		</form>
	</article>
</section>

<?php $content = ob_get_clean(); ?>
