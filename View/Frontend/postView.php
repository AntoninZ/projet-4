
		
	<body class="single-post">
		<header>
			<div>
				<a href="backend.php"><i class="far fa-user-circle" title="Connexion"></i></a>
				<i class="fas fa-bars" onclick="toggleSummary()" title="Sommaire"></i>
			</div>
			<h1>Jean Forteroche <em>Un billet simple pour l'Alaska</em></h1>
			<h2><?= $article->getName();?></h2>	
		</header>
		
		<nav id="summary">
			<h3>Sommaire</h3>
			<hr>
			
			<?php
			
				for($i = 1; $i <= count($list); $i++)
				{
					echo '<ul>' . $list[$i]['chapter'] . '</ul>';
					
					for($j = 0; $j < count($list[$i]['listPosts']); $j++)
					{
						echo '<li><a href="?page=postView&amp;id='. $list[$i]['listPosts'][$j]['id'] .'">'. $list[$i]['listPosts'][$j]['title'] .'</a></li>';	
					}
				}
			?>
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
		
		<section class="post">
			<header>
				<h3>Commentaires</h3>
				<hr>
			</header>
			
			<aside>
				<form method="post" action="?page=postView&amp;id=1&amp;addComment">
					<label for="username">Pseudo :</label>
					<input type="text" id="username" name="username" value="<?= $_SESSION['username']; ?>"></input>
					
					<label for="content">Commentaire :</label>
					<textarea id="content" name="content"></textarea>
					<button type="submit">Ajouter un commentaire</submit>
				</form>
			</aside>
			
			<article>
				<?php foreach ($comments as $object)
				{ ?>
					<div>
						<p><?= $object->getUsername(); ?> - <?= date('d/m/Y H:m:s', strtotime($object->getDate())); ?></p>
						<hr>
						<p><?= $object->getContent(); ?></p>
						<a href="?page=postView&amp;id=<?= $object->getIdPost(); ?>&amp;report&idComment=<?= $object->getId(); ?>">Signaler le commentaire</a>
					</div>
				
				<?php } ?>
			</article>
		</section>
		
