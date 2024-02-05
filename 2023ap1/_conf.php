<?php
$serveurBDD="localhost";
$userBDD="root";
$mdpBDD="";
$nomBDD="2023ap1";

$connexion = mysqli_connect($serveurBDD, $userBDD, $mdpBDD, $nomBDD);



// Check connection
if (!$connexion) {
    die("Connection failed: " . mysqli_connect_error());
}
?>

