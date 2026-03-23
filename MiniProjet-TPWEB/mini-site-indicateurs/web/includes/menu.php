<?php
// Sert a marquer la page active dans le menu
$current = basename($_SERVER['PHP_SELF']);
?>
<header class="site-header">
	<div class="brand">
		<span class="brand-kicker">R4.VCOD.09</span>
		<h1>Rubik Data Lab</h1>
	</div>
	<nav aria-label="Navigation principale">
		<!-- Menu principal commun a toutes les pages -->
		<ul class="nav-list">
			<li><a class="<?php echo $current === 'index.php' ? 'active' : ''; ?>" href="index.php">Accueil</a></li>
			<li><a class="<?php echo $current === 'indicateurs.php' ? 'active' : ''; ?>" href="indicateurs.php">Indicateurs</a></li>
			<li><a class="<?php echo $current === 'analyse.php' ? 'active' : ''; ?>" href="analyse.php">Analyse</a></li>
			<li><a class="<?php echo $current === 'graphiques.php' ? 'active' : ''; ?>" href="graphiques.php">Graphiques</a></li>
		</ul>
	</nav>
</header>

