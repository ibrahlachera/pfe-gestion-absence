<?php
// Configuration de la connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "myappp";

// Établissement de la connexion à la base de données
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Vérification de la connexion à la base de données
if (!$conn) {
    die("La connexion à la base de données a échoué : " . mysqli_connect_error());
}

// Exécution de la requête SQL pour récupérer les données
$sql = "SELECT * FROM etudients WHERE absence > 16";
$result = mysqli_query($conn, $sql);

// Affichage des données récupérées
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "  " . $row["Nom"] . " est depaser   16heure d'absence  <br>";
    }
} else {
    echo "Aucun résultat trouvé.";
}

// Fermeture de la connexion à la base de données
mysqli_close($conn);
