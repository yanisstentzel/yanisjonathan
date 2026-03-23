<?php
// Page d'analyse: filtres envoyes par l'utilisateur
$pageTitle = 'Analyse - Rubik Data Lab';
require_once __DIR__ . '/includes/db.php';

// Valeurs recuperees depuis l'URL (GET)
$country = isset($_GET['country']) ? trim((string) $_GET['country']) : '';
$maxFastest = isset($_GET['max_fastest']) ? (int) $_GET['max_fastest'] : 700;

// On borne la valeur pour rester dans une plage raisonnable
if ($maxFastest < 300) {
	$maxFastest = 300;
}
if ($maxFastest > 1500) {
	$maxFastest = 1500;
}

$rows = [];

try {
	// Requete preparee pour filtrer proprement sans injection SQL
	$sql = 'SELECT result_rank, person, country, fastest_solve
			FROM solves
			WHERE country LIKE :country
			  AND fastest_solve <= :max_fastest
			ORDER BY fastest_solve ASC, result_rank ASC
			LIMIT 100';
	$stmt = $pdo->prepare($sql);
	$stmt->bindValue(':country', $country === '' ? '%' : $country, PDO::PARAM_STR);
	$stmt->bindValue(':max_fastest', $maxFastest, PDO::PARAM_INT);
	$stmt->execute();
	// Resultats limites a 100 lignes pour garder une page lisible
	$rows = $stmt->fetchAll();
} catch (Throwable $e) {
	// Log serveur sans afficher de details techniques au visiteur
	error_log($e->getMessage());
}

require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/menu.php';
?>

<main>
	<section class="card">
		<h2>Analyse personnalisee</h2>
		<p>Filtre les solves par pays et par seuil maximum de fastest_solve.</p>

		<form class="filter-form" method="get" action="analyse.php">
			<label for="country">Pays (exact, ex: USA)</label>
			<input id="country" name="country" type="text" value="<?php echo htmlspecialchars($country, ENT_QUOTES, 'UTF-8'); ?>" placeholder="Laisser vide pour tous les pays">

			<label for="max_fastest">Fastest_solve maximum (ms)</label>
			<input id="max_fastest" name="max_fastest" type="number" min="300" max="1500" step="1" value="<?php echo (int) $maxFastest; ?>">

			<button type="submit">Analyser</button>
		</form>
	</section>

	<section class="card">
		<h3>Resultats (<?php echo count($rows); ?> lignes)</h3>
		<table>
			<thead>
				<tr><th>Rang</th><th>Personne</th><th>Pays</th><th>Fastest</th></tr>
			</thead>
			<tbody>
			<!-- Tableau des lignes correspondant aux filtres -->
			<?php foreach ($rows as $row): ?>
				<tr>
					<td><?php echo (int) $row['result_rank']; ?></td>
					<td><?php echo htmlspecialchars($row['person'], ENT_QUOTES, 'UTF-8'); ?></td>
					<td><?php echo htmlspecialchars($row['country'], ENT_QUOTES, 'UTF-8'); ?></td>
					<td><?php echo (int) $row['fastest_solve']; ?> ms</td>
				</tr>
			<?php endforeach; ?>
			</tbody>
		</table>
	</section>
</main>

<?php require_once __DIR__ . '/includes/footer.php'; ?>

