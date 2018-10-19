<?php
if(isset($_SESSION))
{
	if($_SESSION['role'] == 'admin')
	// Panel d'administration
?>
	<body class="panel-admin">
		<header>
			<h1>Administration</h1>
		</header>
		<span class="navBackground"></span>
		<nav>
			<div>
				<h2>Accès rapide</h2>
				<ul>
					<li>
						<a href="?">
							<i class="fas fa-home"></i>
							Tableau de bord
						</a>
					</li>
					<li>
						<a href="?function=listPost">
							<i class="fas fa-archive"></i>
							Liste des articles
						</a>
					</li>
					<li>
						<a href="?function=listChapter">
							<i class="fas fa-list-ol"></i>
							Liste des chapitres
						</a>
					</li>
					<li>
						<a href="?function=moderate">
							<i class="fas fa-comments"></i>
							Gérer les commentaires
						</a>
					</li>
					<li>
						<a href="?function=members">
							<i class="fas fa-users-cog"></i>
							Gérer les membres
						</a>
					</li>
					<li>
						<a href="?signOut">
							<i class="fas fa-sign-out-alt"></i>
							Se déconnecter
						</a>
					</li>
				</ul>
			</div>
		</nav>
		
		
		<?php echo $content; ?>
		
	</body>
	<!-- Javascript -->
	<script src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		
	<script src="Public/js/main.js"></script>
<?php 
}
else{
	echo "erreur : vous n'avez pas l acces a cette page"
	// Erreur : pas d acces a la page
?>	


<?php } ?>
