
		
	<body class="single-post">
		<header>
			<div>
				<i class="far fa-user-circle" title="Connexion"></i>
				<i class="fas fa-bars" onclick="toggleSummary()" title="Sommaire"></i>
			</div>
			<h1>Jean Forteroche <em>Un billet simple pour l'Alaska</em></h1>
			<h2>Chapitre 1 : <em><?= $article->getidChapter();?></em></h2>	
		</header>
		
		<div id="account">
			<form method="post" action="index.php?action=panel&function=dashboard">
				<label for="username">Pseudo</label>
				<input type="text" id="username" name="username"></input>
				
				<label for="password">Mot de passe</label> 
				<input type="password" id="password" name="password"></input>
				
				<button type="submit">Valider</button>
				<a href="">Créer un compte</a>
			</form>
		</div>
		
		<nav id="summary">
			<h3>Sommaire</h3>
			<hr>
		</nav>
		
		<section class="post">
			<header>
				<h3><?= $article->getTitle();?></h3>
				<hr>
			</header>	
			
			<article>
				<?= $article->getContent();?>
			</article>
			
			<hr>
			<aside class="navigation">
				<a href=""><i class="fas fa-long-arrow-alt-left"></i> Précédent</a>
				<a href="">Suivant <i class="fas fa-long-arrow-alt-right"></i></a>
			</aside>
		</section>
		
		<section class="comment">
			<header>
			</header>
			
			<article>
				
			</article>
		</section>
		
