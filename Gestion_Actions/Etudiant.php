<?php
// Gestion_Actions/Etudiant.php
require_once '../Acces_BD/connexion.php';
require_once '../Acces_BD/Etudiant.php';

$pdo = connect();
$etu = new Etudiant($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['ajouter'])) {
        $etu->add($_POST['code'], $_POST['nom'], $_POST['prenom'], $_POST['email'],
                  $_POST['sexe'], $_POST['filiere']);
        header('Location: ../IHM/Etudiant/affichage.php');
    }
}

if (isset($_GET['delete'])) {
    $etu->delete($_GET['delete']);
    header('Location: ../IHM/Etudiant/affichage.php');
}
