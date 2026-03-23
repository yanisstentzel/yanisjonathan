<?php
// Page d'accueil: texte de contexte du projet
$pageTitle = 'Accueil - Rubik Data Lab';
require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/menu.php';
?>

<main>
	<section class="hero card">
		<!-- Resume court du sujet -->
		<p class="eyebrow">Mini projet TPWEB</p>
		<h2>Analyse des 1000 solves Rubik les plus rapides</h2>
		<p>
			Ce mini-site presente des indicateurs sur un dataset Kaggle contenant les meilleures
			performances de resolution du Rubik's Cube. Le but est de proposer des mesures utiles,
			lisibles et interactives.
		</p>
	</section>

	<section class="grid two-cols">
		<article class="card">
			<h3>Source des donnees</h3>
			<p>Dataset: Top 1000 fastest Rubik's cube solves (Kaggle).</p>
			<p>Colonnes principales: rang, personne, temps de solve, meilleur solve, pays.</p>
		</article>
		<article class="card">
			<h3>Objectifs du site</h3>
			<ul>
				<li>Afficher des indicateurs SQL pertinents.</li>
				<li>Permettre une analyse par filtre utilisateur.</li>
				<li>Visualiser des tendances avec des graphiques dynamiques.</li>
			</ul>
		</article>
	</section>
</main>

<?php require_once __DIR__ . '/includes/footer.php'; ?>

