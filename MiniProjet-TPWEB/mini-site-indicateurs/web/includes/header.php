<?php
// Titre par defaut si la page ne definit rien
if (!isset($pageTitle)) {
	$pageTitle = 'Mini site indicateurs';
}
?>
<!doctype html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Protection XSS sur le titre dynamique -->
	<title><?php echo htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8'); ?></title>
	<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<div class="page-bg"></div>
<div class="layout">

