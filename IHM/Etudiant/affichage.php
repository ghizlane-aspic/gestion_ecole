<?php
/* getenv($host);
getenv($user);
getenv($user);
getenv($dbname);
$conn = mysqli_connect($host, $user, $pass, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

echo $userID; */
$user = [
    'nom' => 'Alice',
    'prenom' => 'becky',
    'cin' => 'h666555',
    'tel' => '0564646466',
    'email' => 'alice@example.com'
];
$mdf=false;

// If the form is submitted, update the values
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $mdf=true;
    $user['nom'] = $_POST['nom'];
    $user['prenom'] = $_POST['prenom'];
    $user['email'] = $_POST['email'];
    $user['tel'] = $_POST['tel'];
    $user['cin'] = $_POST['cin'];
    if($mdf){
    echo "<p style='color:green;'> Modifications enregistrées !</p>";

    }
}




?>
<!DOCTYPE html>
<html>
    <head>
    <title>Informations personnelles</title>
    <link rel="stylesheet" href="../public/style.css">

    </head>
    <body>
    <h2> Informations de l´étudiant:</h2>

<form method="POST">
     <label>CIN:</label><br>
    <input type="text" name="cin" value="<?= htmlspecialchars($user['cin']) ?>"><br><br>
    <label>Nom:</label><br>
    <input type="text" name="nom" value="<?= htmlspecialchars($user['nom']) ?>"><br><br>
     <label>Prénom:</label><br>
    <input type="text" name="prenom" value="<?= htmlspecialchars($user['prenom']) ?>"><br><br>

    <label>Email:</label><br>
    <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>"><br><br>
     <label>Numéro de teléphone:</label><br>
    <input type="text" name="tel" value="<?= htmlspecialchars($user['tel']) ?>"><br><br>
    <button type="submit">Save</button>
</form>



    </body>



</html>
