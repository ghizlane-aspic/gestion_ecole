<!-- IHM/accueil.php -->
<?php 
include(__DIR__ . "/public/images/header.php");
include(__DIR__ . "/public/images/nav_barre.php");
?>

<main class="main-content">
  <section class="dashboard">
    <h2>Bienvenue sur votre tableau de bord</h2>
    <p>Gérez facilement vos étudiants et professeurs depuis cette interface intuitive.</p>

    <div class="cards">
      <div class="card">
        <h3>👩‍🎓 Étudiants</h3>
        <p>Consultez, ajoutez ou modifiez les informations des étudiants.</p>
        <a href="Etudiant/affichage.php" class="btn">Accéder</a>
      </div>

      <div class="card">
        <h3>👨‍🏫 Professeurs</h3>
        <p>Gérez les informations des enseignants et leurs spécialités.</p>
        <a href="Prof/affichage.php" class="btn">Accéder</a>
      </div>
    </div>
  </section>
</main>

<?php include(__DIR__ . "/public/images/footer.php"); ?>
