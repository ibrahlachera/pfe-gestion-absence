<?php

$connection = mysqli_connect("localhost", "root", "");
$db = mysqli_select_db($connection, 'myappp');

if (isset($_POST['updatedata'])) {
    $Nom = $_POST['Nom'];
    $update_id = $_POST['update_id'];
    $cne = $_POST['CNE'];
    $prenom = $_POST['Prenom'];
    $filiere = $_POST['filiere'];
    $absence = $_POST['absence'];

    // chercher si la filière existe déjà: 
    $query = "UPDATE etudients SET `CNE`= '$cne' , `Nom`='$Nom',`Prenom`='$prenom',`filiere`='$filiere',`absence`=$absence WHERE id = $update_id ";
        $query_run = mysqli_query($connection, $query);
        if ($query_run) {
            echo '<script> alert("Modification d\'étudiant avec succès"); </script>';
            header('Location: tables.php');
        } else {
            echo '<script> alert("étudiant non modofié"); </script>';
        }
    }

