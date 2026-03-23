<?php
// Page d'indicateurs: lecture des KPI depuis la base
$pageTitle = 'Indicateurs - Rubik Data Lab';
require_once __DIR__ . '/includes/db.php';

// Valeurs par defaut en cas de souci SQL
$stats = [
	'total_solves' => 0,
	'avg_fastest' => 0,
	'best_fastest' => 0,
];
$topCountries = [];
$topPeople = [];

try {
	// KPI globaux
	$stats = $pdo->query(
		'SELECT COUNT(*) AS total_solves, AVG(fastest_solve) AS avg_fastest, MIN(fastest_solve) AS best_fastest FROM solves'
	)->fetch();

	// Top pays
	$topCountries = $pdo->query(
		'SELECT country, COUNT(*) AS nb_solves
		 FROM solves
		 GROUP BY country
		 ORDER BY nb_solves DESC, country ASC
		 LIMIT 10'
	)->fetchAll();

	// Top personnes les plus presentes
	$topPeople = $pdo->query(
		'SELECT person, country, COUNT(*) AS nb_entries, MIN(fastest_solve) AS best_time
		 FROM solves
		 GROUP BY person, country
		 ORDER BY nb_entries DESC, best_time ASC
		 LIMIT 10'
	)->fetchAll();
} catch (Throwable $e) {
	// On evite de casser la page, on garde juste une trace serveur
	error_log($e->getMessage());
}

require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/menu.php';
?>

<main>
	<section class="grid three-cols">
		<article class="card stat">
			<h3>Total solves</h3>
			<p class="metric"><?php echo (int) $stats['total_solves']; ?></p>
		</article>
		<article class="card stat">
			<h3>Moyenne fastest_solve</h3>
			<p class="metric"><?php echo number_format((float) $stats['avg_fastest'], 2, ',', ' '); ?> ms</p>
		</article>
		<article class="card stat">
			<h3>Meilleur fastest_solve</h3>
			<p class="metric"><?php echo (int) $stats['best_fastest']; ?> ms</p>
		</article>
	</section>

	<section class="grid two-cols">
		<article class="card">
			<h3>Top 10 pays par nombre de solves</h3>
			<table>
				<thead>
					<tr><th>Pays</th><th>Nb solves</th></tr>
				</thead>
				<tbody>
				<!-- Affichage ligne par ligne du top pays -->
				<?php foreach ($topCountries as $row): ?>
					<tr>
						<td><?php echo htmlspecialchars($row['country'], ENT_QUOTES, 'UTF-8'); ?></td>
						<td><?php echo (int) $row['nb_solves']; ?></td>
					</tr>
				<?php endforeach; ?>
				</tbody>
			</table>
		</article>

		<article class="card">
			<h3>Top 10 personnes les plus presentes</h3>
			<table>
				<thead>
					<tr><th>Personne</th><th>Pays</th><th>Nb entrees</th><th>Best time</th></tr>
				</thead>
				<tbody>
				<!-- Affichage ligne par ligne du top personnes -->
				<?php foreach ($topPeople as $row): ?>
					<tr>
						<td><?php echo htmlspecialchars($row['person'], ENT_QUOTES, 'UTF-8'); ?></td>
						<td><?php echo htmlspecialchars($row['country'], ENT_QUOTES, 'UTF-8'); ?></td>
						<td><?php echo (int) $row['nb_entries']; ?></td>
						<td><?php echo (int) $row['best_time']; ?> ms</td>
					</tr>
				<?php endforeach; ?>
				</tbody>
			</table>
		</article>
	</section>
</main>

<?php require_once __DIR__ . '/includes/footer.php'; ?>

