<?php
    $dbType = getenv('DB_TYPE') ?: 'mysql';

    $host = $dbType === 'mysql' ? getenv('MYSQL_HOST') : getenv('PG_HOST');
    $dbname = $dbType === 'mysql' ? getenv('MYSQL_DATABASE') : getenv('PG_DATABASE');
    $username = $dbType === 'mysql' ? getenv('MYSQL_USER') : getenv('PG_USER');
    $password = $dbType === 'mysql' ? getenv('MYSQL_PASSWORD') : getenv('PG_PASSWORD');

    // Connection à la base de données
    try {
        if ($dbType === 'mysql') {
            $dsn = "mysql:host=$host;dbname=$dbname";
            $db = new PDO($dsn, $username, $password);
        } else if ($dbType === 'pgsql' || $dbType === 'postgres') {
            $dsn = "pgsql:host=$host;dbname=$dbname";
            $db = new PDO($dsn, $username, $password);
        } else {
            throw new Exception("Unsupported database type: $dbType");
        }
        
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }
?>