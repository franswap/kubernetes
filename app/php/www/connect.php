<?php
/**
 * connect.php  
 * Connexion PDO à PostgreSQL en utilisant les variables d'environnement 
 *   PG_HOST, PG_DATABASE, PG_USER, PG_PASSWORD
 */

$host     = getenv('PG_HOST');
$dbname   = getenv('PG_DATABASE');
$username = getenv('PG_USER');
$password = getenv('PG_PASSWORD');

try {
    // DSN PostgreSQL : "pgsql:host=...;dbname=..."
    $dsn = "pgsql:host=$host;dbname=$dbname";
    $db = new PDO($dsn, $username, $password);
    // Mode d'erreur exceptions et fetch associatif par défaut
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erreur de connexion PostgreSQL : " . $e->getMessage());
}
