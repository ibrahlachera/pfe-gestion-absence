<?php

$connection = mysqli_connect("localhost", "root", "");
$db = mysqli_select_db($connection, 'myappp');

if (isset($_POST['insertdata'])) {
    $Nom = $_POST['Nom'];
    $Abrev = $_POST['Abrev'];
    $deppar = $_POST['deppar'];
    $Netud = $_POST['Netud'];


    $query = "INSERT INTO filier (`Nom`,`Abrev`,`deppar` ,`Netud`) VALUES ('$Nom','$Abrev' ,'$deppar','$Netud')";
    $query_run = mysqli_query($connection, $query);

    if ($query_run) {
        echo '<script> alert("Data Saved"); </script>';
        header('Location: ajouter.php');
    } else {
        echo '<script> alert("Data Not Saved"); </script>';
    }
}
