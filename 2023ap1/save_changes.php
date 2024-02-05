<?php
session_start();
include '_conf.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $editedCommentId = $_POST['id'];
    $editedComment = $_POST['comment'];

    $connexion = mysqli_connect($serveurBDD, $userBDD, $mdpBDD, $nomBDD);

    $editedComment = mysqli_real_escape_string($connexion, $editedComment);

    $requete = "UPDATE cr SET description = '$editedComment' WHERE num = $editedCommentId";

}
?>
