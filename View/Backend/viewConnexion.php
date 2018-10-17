<body class="panel-connexion">
	<header>
		<h1>Connexion</h1>
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
			</form>
			
			<form id="signUp" method="post" action="?signUp">
				<h2>Inscription</h2>
				<hr>
				<label for="username2">Pseudo</label>
				<input type="text" id="username2" name="username2" placeholder="Entrez un pseudo" required ></input>
				
				<label for="password2">Mot de passe</label>
				<input type="password" id="password2" name="password2" required ></label>
				
				<label for="passwordCheck">Confirmation du mot de passe</label>
				<input type="password" id="passwordCheck" name="passwordCheck" required ></input>
				
				<button type="submit">S'inscrire</button>
			</form>
		</article>
	</section>

