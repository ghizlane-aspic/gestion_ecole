<?php
// Gestion_Actions\Professeur.php

require_once 'connexion.php';

class Professeur {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function add($code, $nom, $prenom, $email, $langues, $specialite, $mot_de_passe) {
        $hash = password_hash($mot_de_passe, PASSWORD_DEFAULT);
        $sql = "INSERT INTO prof (code, nom, prenom, email, langues, specialite, mot_de_passe)
                VALUES (:code, :nom, :prenom, :email, :langues, :specialite, :mot_de_passe)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            'code' => $code,
            'nom' => $nom,
            'prenom' => $prenom,
            'email' => $email,
            'langues' => $langues,
            'specialite' => $specialite,
            'mot_de_passe' => $hash
        ]);
    }

    public function update($id, $code, $nom, $prenom, $email, $langues, $specialite) {
        $sql = "UPDATE prof SET code=:code, nom=:nom, prenom=:prenom, email=:email, langues=:langues, specialite=:specialite
                WHERE id=:id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            'id' => $id,
            'code' => $code,
            'nom' => $nom,
            'prenom' => $prenom,
            'email' => $email,
            'langues' => $langues,
            'specialite' => $specialite
        ]);
    }

    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM prof WHERE id=:id");
        return $stmt->execute(['id' => $id]);
    }

    public function getAll() {
        $stmt = $this->pdo->query("SELECT id, code, nom, prenom, email, langues, specialite FROM prof");
        return $stmt->fetchAll();
    }

    public function getById($id) {
        $stmt = $this->pdo->prepare("SELECT id, code, nom, prenom, email, langues, specialite FROM prof WHERE id=:id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }
}
