
		
	<body class="single-post">
		<header>
			<div>
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
		
