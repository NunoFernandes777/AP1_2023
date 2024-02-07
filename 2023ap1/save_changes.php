<?php
session_start();
include '_conf.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $editedCommentId = $_POST['num'];
    $editedComment = $_POST['comment'];

    $editedComment = mysqli_real_escape_string($connexion, $editedComment);

    $requete = "UPDATE cr SET description = '$editedComment' WHERE num = $editedCommentId";

}
?>
