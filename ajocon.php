<?php

$connection = mysqli_connect("localhost", "root", "");
$db = mysqli_select_db($connection, 'myappp');

if (isset($_POST['insertdata'])) {
    $Nom = $_POST['Nom'];
    $Abrev = $_POST['Abrev'];
    $deppar = $_POST['deppar'];
    $Netud = $_POST['Netud'];

    // chercher si la filière existe déjà: 
    $query_find_filiere = "SELECT * FROM filier WHERE Nom = '$Nom' OR Abrev = '$Abrev'";
    $query_find_run = mysqli_query($connection, $query_find_filiere);

    $query = "INSERT INTO filier (`Nom`,`Abrev`,`deppar` ,`Netud`) VALUES ('$Nom','$Abrev' ,'$deppar','$Netud')";
    if($query_find_run->num_rows ==0 ){
        $query_run = mysqli_query($connection, $query);
        if ($query_run) {
            echo '<script> alert("Data Saved"); </script>';
            header('Location: ajouter.php');
        } else {
            echo '<script> alert("Data Not Saved"); </script>';
        }
    }else{
        echo '<script> alert("Filière déjà existe dans la DB, veuillez saisir une autre filière"); </script>';
        header( "refresh:0;url=ajouter.php" );
    }
}
