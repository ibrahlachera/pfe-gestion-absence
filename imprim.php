<?php
require('fpdf.php');

// Connexion à la base de données
$con = mysqli_connect("localhost", "root", "", "myappp");
if (!$con) {
    die("La connexion à la base de données a échoué : " . mysqli_connect_error());
}

// Vérification que l'utilisateur a saisi une filière valide
if (isset($_POST['filiere']) && is_string($_POST['filiere'])) {
    $filiere = $_POST['filiere'];
} else {
    die("La filière spécifiée est invalide.");
}

// Requête SQL pour récupérer les données filtrées par filière
$stmt = $con->prepare("SELECT * FROM etudients WHERE filiere = ?");
$stmt->bind_param("s", $filiere);
$stmt->execute();
$result = $stmt->get_result();

// Création du PDF
$pdf = new FPDF();
$pdf->AddPage();

// Ajout des en-têtes de colonne
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(40, 10, 'CNE', 1);
$pdf->Cell(40, 10, 'Nom', 1);
$pdf->Cell(40, 10, 'Prenom', 1);
$pdf->Cell(40, 10, 'filiere', 1);
$pdf->Cell(40, 10, 'absence', 1);
$pdf->Ln();

// Ajout des données de la table
$pdf->SetFont('Arial', '', 12);
while ($row = mysqli_fetch_array($result)) {
    $pdf->Cell(40, 10, $row['CNE'], 1);
    $pdf->Cell(40, 10, $row['Nom'], 1);
    $pdf->Cell(40, 10, $row['Prenom'], 1);
    $pdf->Cell(40, 10, $row['filiere'], 1);
    $pdf->Cell(40, 10, $row['absence'], 1);
    $pdf->Ln();
}

// Envoi du PDF généré au navigateur
$pdf->Output();
