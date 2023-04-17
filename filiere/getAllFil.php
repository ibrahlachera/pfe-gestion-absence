<?php
$connection = mysqli_connect("localhost", "root", "");
$db = mysqli_select_db($connection, 'myappp');
$query_all_filiere = "SELECT * FROM filier";
$query_find_run = mysqli_query($connection, $query_all_filiere);
$filieres =  $query_find_run->fetch_all();