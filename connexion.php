<?php

$connection = mysqli_connect("localhost", "root", "");
$db = mysqli_select_db($connection, 'myappp');

// Include config file


// Define variables and initialize with empty values
$CNE = $Nom = $prenom = $filiere = $absence = "";
$CNE_err = $nom_err = $prenom_err =  $filiere_err = $absence_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $input_CNE = trim($_POST["CNE"]);
    if (empty($input_CNE)) {
        $CNE_err = "Veuillez saisir un CNE.";
    } elseif (!ctype_digit($input_CNE)) {
        $CNE_err = "Le CNE doit être un entier.";
    } else {
        $CNE = $input_CNE;
    }
    // Validate nom
    $input_nom = trim($_POST["Nom"]);
    if (empty($input_nom)) {
        $nom_err = "Veuillez saisir un nom.";
    } elseif (!ctype_alpha($input_nom)) {
        $nom_err = "Le nom ne doit contenir que des lettres.";
    } else {
        $Nom = $input_nom;
    }

    // Validate prénom
    $input_prenom = trim($_POST["Prenom"]);
    if (empty($input_prenom)) {
        $prenom_err = "Veuillez saisir un prénom.";
    } elseif (!ctype_alpha($input_prenom)) {
        $prenom_err = "Le prénom ne doit contenir que des lettres.";
    } else {
        $prenom = $input_prenom;
    }

    $input_filiere = trim($_POST["filiere"]);
    if (empty($input_filiere)) {
        $filiere_err = "Veuillez saisir un filier.";
    } elseif (!ctype_alpha($input_filiere)) {
        $filiere_err = "Le filier ne doit contenir que des lettres.";
    } else {
        $filiere = $input_filiere;
    }

    // Validate nombre
    $input_absence = trim($_POST["absence"]);
    if (empty($input_absence)) {
        $absence_err = "Veuillez saisir un nombre.";
    } elseif (!ctype_digit($input_absence)) {
        $absence_err = "Le nombre doit être un entier.";
    } else {
        $absence = $input_absence;
    }

    // Check input errors before inserting in database
    if (empty($CNE_err) && empty($nom_err) && empty($prenom_err) && empty($filiere_err) && empty($absence_err)) {
        // Prepare an insert statement
        $sql = "INSERT INTO etudients (CNE,Nom, Prenom,filiere ,absence ) VALUES (?, ?, ?, ?,?)";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssss", $param_CNE, $param_name, $param_prenom, $param_filiere, $param_absence);

            // Set parameters
            $param_CNE = $CNE;
            $param_name = $Nom;
            $param_prenom = $prenom;
            $param_filiere = $filiere;
            $param_absence = $absence;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Records created successfully. Redirect to landing page
                header("location: index.php");
                exit();
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }

    // Close connection
    mysqli_close($link);
}
?>
