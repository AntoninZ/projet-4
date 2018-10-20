

<section class="post">
	<header>
		<h3>Commentaires</h3>
		<hr>
	</header>
		
	<?php if(isset($_SESSION['username']))
	{
		// ADD A COMMENT (USER ALREADY CONNECTED) ?>
	
		<aside>
			<form method="post" action="?page=postView&amp;id=<?= $_GET['id']; ?>&amp;addComment">
				
				
				<label for="content">Commentaire :</label>
				<textarea id="content" name="content"></textarea>
				<button type="submit">Ajouter un commentaire</submit>
			</form>
		</aside>
	
	<?php
	}
	else // SIGN IN FORM
	{?>

		<aside>
			<form id="signIn" method="post" action="?page=postView&amp;id=<?= $_GET['id']; ?>&amp;signIn">
				<label for="username">Pseudo :</label>
				<input type="text" id="username" name="username"></input>
				
				<label for="password">Mot de passe :</label>
				<input type="password" id="password" name="password"></input>
				<button type="submit">Se connecter</button>
				<p onclick="slide('#signIn','#signUp')">Pas encore inscrit ? S'inscrire.</p>
			</form>
			
			<form id="signUp" method="post" action="?page=postView&amp;id=<?= $_GET['id']; ?>&amp;signUp" style="display:none">
				<label for="newUsername">Pseudo :</label>
				<input type="text" id="newUsername2" name="newUsername"></input>
				
				<label for="newPassword">Mot de passe :<label>
				<input type="password" id="newPassword" name="newPassword"></input>
				
				<label for="passwordCheck">Entrez à nouveau votre mot de passe :</label>
				<input type="password" id="passwordCheck" name="passwordCheck"></input>
				
				<button type="submit">S'inscrire</button>
				<p onclick="slide('#signUp','#signIn')">Revenir au formulaire de connexion.</p>
			</form>
			
			
			<?php if(isset($error)){ ?>
			<div class="error"><?= $error ?></div>
			<?php } ?>
		</aside>
	<?php
	} ?>
	
		<article id="commentaire">
		<?php foreach ($comments as $object)
		{ ?>
			<div>
				<p><?= $object->getUsername(); ?><?= date(' \l\e d/m/Y à H:m:s', strtotime($object->getDate())); ?></p>
				<hr>
				<p><?= $object->getContent(); ?></p>
				<a href="?page=postView&amp;id=<?= $object->getIdPost(); ?>&amp;report&idComment=<?= $object->getId(); ?>">Signaler le commentaire</a>
			</div>
		
		<?php
		} 
		?>
	</article>
</section>
