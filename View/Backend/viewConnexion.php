<body class="panel-connexion">
	<header>
		<h1><a href="index.php">Jean Forteroche - <span>Un billet simple pour l'alaska</span></a></h1>
		<h2>Accès à l'administration</h2>
	</header>
	
	<section>
		<article>
			<form id="signIn" method="post" action="?signIn">
				<h2>Connexion</h2>
				<hr>
				<label for="username">Pseudo</label>
				<input type="text" id="username" name="username" required placeholder="Entrez votre pseudo"></input>
				
				<label for="password">Mot de passe</label>
				<input type="password" id="password" name="password" required ></input>
				
				<button type="submit">Se connecter</button>
				
				<?php if(!empty($message)){ ?>
				
				<p class="error"><?= $message ?></p>
				
				<?php } ?>
			</form>
		</article>
	</section>

