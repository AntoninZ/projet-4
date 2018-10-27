

<section class="comment">
	<header>
		<h3>Commentaires</h3>
	</header>
		
	<?php if(isset($_SESSION['username']))
	{
		// ADD A COMMENT (USER ALREADY CONNECTED) ?>
	
		<aside class="commentForm">
			<form method="post" action="?page=postView&amp;id=<?= $_GET['id']; ?>&amp;addComment">
				<label for="content">Ajouter un commentaire (maximum 300 caractères) :</label>
				<textarea id="content" name="content" maxlength="300" required></textarea>
				<button type="submit">Ajouter un commentaire</button>
				<br />
				<a href="?page=postView&amp;id=<?= $_GET['id']; ?>&amp;signOut">Déconnexion</a>
			</form>
			
		</aside>
	
	<?php
	}
	else // SIGN IN FORM
	{?>

		<aside>
			<form id="signIn" method="post" action="?page=postView&amp;id=<?= $_GET['id']; ?>&amp;signIn">
				<div>
					<label for="username">Pseudo :</label>
					<input type="text" id="username" name="username" required>
				</div>
				
				<div>
					<label for="password">Mot de passe :</label>
					<input type="password" id="password" name="password" required>
				</div>
				<button type="submit">Se connecter</button>
				<p onclick="slide('#signIn','#signUp')">Pas encore inscrit ? S'inscrire.</p>
			</form>
			
			<!-- SIGN UP FORM -->
			<form id="signUp" method="post" action="?page=postView&amp;id=<?= $_GET['id']; ?>&amp;signUp" style="display:none">
				
					<div>
						<label for="newUsername">Pseudo :</label>
						<input type="text" id="newUsername" name="newUsername" required>
					</div>
					
					<div>
						<label for="newPassword">Mot de passe :</label>
						<input type="password" id="newPassword" name="newPassword" required>
					</div>
					
					<div>
						<label for="passwordCheck">Confirmer votre mot de passe :</label>
						<input type="password" id="passwordCheck" name="passwordCheck" required>
					</div>
				
				
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
				<a href="?page=postView&amp;id=<?= $object->getIdPost(); ?>&amp;report&idComment=<?= $object->getId(); ?>">Signaler <i class="fas fa-exclamation-circle"></i></a>
				<p class="author"><?= $object->getUsername(); ?></p>
				<p class="content"><?= $object->getContent(); ?></p>
				<p class="date"><?= date(' \l\e d/m/Y à H:m:s', strtotime($object->getDate())); ?></p>
			</div>
		
		<?php
		} 
		?>
	</article>
</section>
