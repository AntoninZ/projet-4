<body class="single-post">
	<header>
		
		<h1><a href="index.php">Jean Forteroche - <span>Un billet simple pour l'alaska</span></a></h1>
		<h2>Formulaire de contact</h2>	
		<div>
			<i class="fas fa-bars" onclick="toggleSummary()" title="Sommaire"></i>
		</div>
	</header>
	
	<section class="contact">
		<form method="post" action="?page=contact&amp;send">
			<label for="name">Nom et prénom :</label>
			<input type="text" name="name" id="name" placeholder="Entrez votre nom et prénom"></input>
			
			<label for="email">Email :</label>
			<input type="text" name="email" id="email" placeholder="Entrez votre adresse email"></input>
			
			<label for="message">Message :</label>
			<textarea name="message" id="message"></textarea>
			
			<button type="submit">Envoyer</button>
		</form>
	</section>