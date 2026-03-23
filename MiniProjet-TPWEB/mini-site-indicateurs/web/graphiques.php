<?php
// Page graphiques: on prepare les donnees pour Chart.js
$pageTitle = 'Graphiques - Rubik Data Lab';
$includeCharts = true;
require_once __DIR__ . '/includes/db.php';

$countries = [];
$distribution = [];

try {
	// Top 10 pays par volume de solves
	$countries = $pdo->query(
		'SELECT country, COUNT(*) AS nb_solves
		 FROM solves
		 GROUP BY country
		 ORDER BY nb_solves DESC, country ASC
		 LIMIT 10'
	)->fetchAll();

	// Repartition en tranches de performances
	$distribution = $pdo->query(
		"SELECT
			CASE
				WHEN fastest_solve < 400 THEN 'lt400'
				WHEN fastest_solve BETWEEN 400 AND 449 THEN '400_449'
				WHEN fastest_solve BETWEEN 450 AND 499 THEN '450_499'
				WHEN fastest_solve BETWEEN 500 AND 549 THEN '500_549'
				ELSE 'gte550'
			END AS bucket,
			COUNT(*) AS nb
		 FROM solves
		 GROUP BY bucket
		 ORDER BY bucket"
	)->fetchAll();
} catch (Throwable $e) {
	// Log technique en cas d'erreur SQL
	error_log($e->getMessage());
}

require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/menu.php';
?>

<main>
	<section class="grid two-cols">
		<article class="card">
			<h2>Top 10 pays</h2>
			<canvas id="countriesChart" height="200"></canvas>
		</article>
		<article class="card">
			<h2>Distribution fastest_solve</h2>
			<canvas id="distributionChart" height="200"></canvas>
		</article>
	</section>
</main>

<script>
// Passage des donnees PHP vers JavaScript pour les graphiques
window.chartData = {
	countries: <?php echo json_encode($countries, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); ?>,
	distribution: <?php echo json_encode($distribution, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); ?>
};
</script>

<?php require_once __DIR__ . '/includes/footer.php'; ?>

