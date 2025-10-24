<?php
// Acces_BD\Etudiant.php

require_once 'connexion.php';

class Etudiant {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function add($code, $nom, $prenom, $email, $sexe, $filiere) {
        $sql = "INSERT INTO etudiant (code, nom, prenom, email, sexe, filiere)
                VALUES (:code, :nom, :prenom, :email, :sexe, :filiere)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            'code' => $code,
            'nom' => $nom,
            'prenom' => $prenom,
            'email' => $email,
            'sexe' => $sexe,
            'filiere' => $filiere
        ]);
    }

    public function getAll() {
        $stmt = $this->pdo->query("SELECT * FROM etudiant");
        return $stmt->fetchAll();
    }

    public function getById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM etudiant WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM etudiant WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}
