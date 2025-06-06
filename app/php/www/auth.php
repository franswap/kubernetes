<?php
session_start();

// On vérifie que le formulaire a bien été soumis en POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // On s’assure que les clés existent dans $_POST
    if (!isset($_POST['US_login']) || !isset($_POST['US_password'])) {
        // Rediriger vers la page de login si un champ manque
        header("Location: index.php");
        exit();
    }

    // Récupération des valeurs du formulaire
    $login    = trim($_POST['US_login']);
    $password = $_POST['US_password'];

    // Inclusion du fichier de connexion PostgreSQL (connect.php doit instancier $db via PDO pgsql)
    include 'connect.php';

    try {
        // Requête d’authentification PostgreSQL :
        // digest(...,'sha256') renvoie un bytea, on encode en hexadécimal pour comparer avec US_password stocké en CHAR(64)
        $sql = "
            SELECT *
              FROM utilisateurs
             WHERE US_login = :login
               AND US_password = encode(digest(:pwd, 'sha256'), 'hex')
        ";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':login', $login, PDO::PARAM_STR);
        $stmt->bindValue(':pwd',   $password, PDO::PARAM_STR);
        $stmt->execute();

        $utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($utilisateur) {
            // Authentification réussie
            $_SESSION['login'] = $utilisateur['US_login'];
            header("Location: home.php");
            exit();
        } else {
            // Identifiants invalides
            header("Location: Location: BADUSER.html");
            exit();
        }

    } catch (PDOException $e) {
        // En cas d’erreur SQL (table manquante, etc.), rediriger vers une page d’erreur
        header("Location: error_database.php");
        exit();
    }

} else {
    header("Location: BADUSER.html");
    exit();
}
