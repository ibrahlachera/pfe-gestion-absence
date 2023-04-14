<?php

$connection = mysqli_connect("localhost", "root", "");
$db = mysqli_select_db($connection, 'myappp');

if (isset($_POST['insererdatabase'])) {
    $Nom = $_POST['Nom'];
    $cne = $_POST['CNE'];
    $prenom = $_POST['prenom'];
    $filiere = $_POST['filiere'];
    $absence = $_POST['absence'];

    // chercher si la filière existe déjà: 
    $query_find_student = "SELECT * FROM etudients WHERE CNE = $cne";
    $query_find_run = mysqli_query($connection, $query_find_student);
    $query = "INSERT INTO etudients (`CNE`,`Nom`,`Prenom` ,`filiere` ,`absence`) VALUES ('$cne','$Nom' ,'$prenom','$filiere',$absence)";
    if($query_find_run->num_rows ==0 ){
        $query_run = mysqli_query($connection, $query);
        if ($query_run) {
            echo '<script> alert("Ajout d\'étudiant avec succès"); </script>';
            header('Location: tables.php');
        } else {
            echo '<script> alert("étudiant non ajouté"); </script>';
        }
    }else{
        echo '<script> alert("Etudiant existe déjà"); </script>';
        header( "refresh:0;url=tables.php" );
    }
}
