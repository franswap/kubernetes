<?php
    if (isset($_POST['us_login']) and isset($_POST['us_password'])) {
        session_start();
        include 'connect.php';

        ini_set('display_errors', '1');

        $sql = "SELECT * FROM utilisateurs WHERE us_login = :login AND us_password = ENCODE(DIGEST(:password, 'sha256'), 'hex')";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':login', $_POST['us_login']);
        $stmt->bindParam(':password', $_POST['us_password']);
        $stmt->execute();
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($res != false) {

            if ( count($res) > 0) {
                // Utilisateur trouvé dans la base
                $utilisateur = $res[0];
                $_SESSION['login'] = $utilisateur['us_login'];
                header("Location: home.php");
            } else {
                header("Location: index.php");
            }
        } else {
            header("Location: BADUSER.html");
        }
    }
?>