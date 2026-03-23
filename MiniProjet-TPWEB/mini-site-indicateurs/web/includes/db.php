<?php
require_once __DIR__ . '/../../vendor/autoload.php';

// Charge les variables du fichier .env
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../../');
$dotenv->load();
// Récupération des données via $_ENV ou getenv()
$host    = $_ENV['DB_HOST'];
$db      = $_ENV['DB_NAME'];
$user    = $_ENV['DB_USER'];
$pass    = $_ENV['DB_PASS'];
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

// Parametres PDO: erreurs en exception + resultats en tableau associatif
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
     // Connexion disponible dans $pdo pour toutes les pages
     $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
     // On log l'erreur discrètement
     error_log($e->getMessage());
     die("Site momentanément indisponible.");
}