<?php
$connection = mysqli_connect("localhost", "root", "");
$db = mysqli_select_db($connection, 'myappp');

if (isset($_POST['deletedatafil'])) {
    $nom_fil_del = $_POST['nom_fil_del'];

    $query = "DELETE FROM filier WHERE Nom='$nom_fil_del'";
    $query_run = mysqli_query($connection, $query);

    if ($query_run) {
        echo '<script> alert("Data Deleted"); </script>';
        header("Location:../ajouter.php");
    } else {
        echo '<script> alert("Data Not Deleted"); </script>';
    }
}
