<?php
$user = 'stentzey'; // à changer par votre login sur mysql
$password = '0111'; // à changer par votre passwd sur mysql
$db = 'stentzey2'; // à changer par le nom de votre BD
$host = 'etu-mysql.iut2.univ-grenoble-alpes.fr';

try
{
$pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8",
$user, $password);
}
catch (Exception $e)
{
die('Erreur : ' . $e->getMessage());
}
?>