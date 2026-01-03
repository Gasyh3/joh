<?php
$dbHost = 'db';
$dbName = 'influmatch';
$dbUser = 'influmatch_user';
$dbPassword = 'influmatch_pass';
$charset = 'utf8mb4';

$dsn = "mysql:host={$dbHost};dbname={$dbName};charset={$charset}";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $pdo = new PDO($dsn, $dbUser, $dbPassword, $options);
} catch (PDOException $e) {
    exit('Erreur de connexion a la base de donnees');
}
