<?php
session_start();
include '_conf.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['id'])) {
        $commentId = $_POST['id'];


        $connexion = mysqli_connect($serveurBDD, $userBDD, $mdpBDD, $nomBDD);


        $requete = "DELETE FROM cr WHERE num = ?";
        $stmt = mysqli_prepare($connexion, $requete);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "i", $commentId);


            if (mysqli_stmt_execute($stmt)) {

                echo "Supprimé.";
            } else {

                echo "Erreur a supprimer: " . mysqli_error($connexion);
            }

            mysqli_stmt_close($stmt);
        } else {

            echo mysqli_error($connexion);
        }


        mysqli_close($connexion);
    } else {

        echo "ID";
    }
}
?>