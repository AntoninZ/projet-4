<?php
if(isset($_SESSION) && $_SESSION['role'] == 'admin')
{
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
						<a href="?action=panel&function=dashboard">
							<i class="fas fa-home"></i>
							Tableau de bord
						</a>
					</li>
					<li>
						<a href="?action=panel&function=add">
							<i class="fas fa-plus"></i>
							Nouvel article
						</a>
					</li>
					<li>
						<a href="?action=panel&function=listPost">
							<i class="fas fa-archive"></i>
							Liste des articles
						</a>
					</li>
					<li>
						<a href="?action=panel&function=moderate">
							<i class="fas fa-comments"></i>
							Commentaires
						</a>
					</li>
					<li>
						<a href="?action=panel&function=members">
							<i class="fas fa-users-cog"></i>
							Gérer les membres
						</a>
					</li>
				</ul>
			</div>
		</nav>
		
		<!-- Add viewAddPost or ViewListPost or ViewListComment -->
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
