<?php

$connection = mysqli_connect("localhost", "root", "");
$db = mysqli_select_db($connection, 'myappp');

if (isset($_POST['updatedatafil'])) {
    $nom_fil = $_POST['nom_fil'];
    $update_name = $_POST['update_name'];
    $abrev = $_POST['abrev'];
    $dept = $_POST['dept'];
    $number_stud = $_POST['number_stud'];
    // chercher si la filière existe déjà: 
    $query_find_filiere = "SELECT * FROM filier WHERE Nom = '$nom_fil'";
    $query_find_run = mysqli_query($connection, $query_find_filiere);
    $query = "UPDATE filier SET  `Nom`='$nom_fil',`Abrev`='$abrev',`deppar`='$dept',`netud`=$number_stud WHERE `Nom` = '$update_name' ";
    if($query_find_run->num_rows ==0 ){
        $query_run = mysqli_query($connection, $query);
        if ($query_run) {
            echo '<script> alert("Modification de filière avec succès"); </script>';
            header('Location: ../ajouter.php');
        } else {
            echo '<script> alert("filière non modofiée"); </script>';
        }
    }else{
        echo '<script> alert("Filière déjà existe dans la DB, veuillez saisir une autre filière"); </script>';
        header( "refresh:0;url=../ajouter.php" );
    }
      
    }

