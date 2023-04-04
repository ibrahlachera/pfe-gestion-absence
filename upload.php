<?php

// Vérifie si le formulaire a été soumis
if (isset($_POST['updatedata'])) {

    // Connexion à la base de données
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "myappp";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Vérifie si la connexion a réussi
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Récupère les données du formulaire

    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $course = $_POST['course'];
    $contact = $_POST['contact'];
    $absence = $_POST['absence'];

    // Met à jour les données dans la base de données
    $sql = "UPDATE etudients SET fname='$fname', lname='$lname', course='$course', contact='$contact', absence='$absence' ";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }

    // Ferme la connexion à la base de données
    $conn->close();
}
