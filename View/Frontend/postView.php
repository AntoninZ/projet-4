
		
	<body class="single-post">
		<header>
			
			<h1><a href="index.php">Jean Forteroche - <span>Un billet simple pour l'alaska</span></a></h1>
			<h2><?= $article->getName();?></h2>	
			<div>
				<i class="fas fa-bars" onclick="toggleSummary()" title="Sommaire"></i>
			</div>
		</header>
		
		<nav id="summary">
			<h3>Sommaire</h3>
			<hr>
			<dl>
			<?php
			
				for($i = 1; $i <= count($list); $i++)
				{
					echo '<dt>' . $list[$i]['chapter'] . '</dt>';
					
					for($j = 0; $j < count($list[$i]['listPosts']); $j++)
					{
						echo '<dd>- <a href="?page=postView&amp;id='. $list[$i]['listPosts'][$j]['id'] .'">'. $list[$i]['listPosts'][$j]['title'] .'</a></dd>';	
					}
				}
			?>
			</dl>
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
			<?php
				if($previous > 0)
				{
					echo '<a class="previous" href="?page=postView&id='. $previous .'"><i class="fas fa-long-arrow-alt-left"></i> Précédent</a>';
				}
				
				if($next <= $count)
				{
					echo '<a class="next" href="?page=postView&id='. $next .'">Suivant <i class="fas fa-long-arrow-alt-right"></i></a>';
				}
			?>
			</aside>
		</section>
		<i class="fas fa-arrow-up" onclick="buttonTop()"></i>
