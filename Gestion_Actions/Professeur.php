<?php
// Gestion_Actions/Professeur.php

require_once '../Acces_BD/connexion.php';
require_once '../Acces_BD/Professeur.php';

$pdo = connect();
$prof = new Professeur($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['ajouter'])) {
        $prof->add($_POST['code'], $_POST['nom'], $_POST['prenom'], $_POST['email'],
                   $_POST['langues'], $_POST['specialite'], $_POST['mot_de_passe']);
        header('Location: ../IHM/Prof/affichage.php');
    }
}

if (isset($_GET['delete'])) {
    $prof->delete($_GET['delete']);
    header('Location: ../IHM/Prof/affichage.php');
}