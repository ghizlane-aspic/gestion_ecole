<?php
require_once '../Acces_BD/login.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = htmlspecialchars($_POST['email']);
    $password = $_POST['password'];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Format d'email invalide !");
    }

    if (login($email, $password) === false) {
        echo "<p style='color:red;'>Identifiants incorrects.</p>";
        echo "<a href='../index.php'>Retour</a>";
    }
}

if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    logout();
}
?>
