<?php
session_start();
include '_conf.php';

// Verifique se a solicitação é um POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifique se o ID do comentário foi fornecido
    if (isset($_POST['id'])) {
        $commentId = $_POST['id'];
        
        // Conecte-se ao banco de dados
        $connexion = mysqli_connect($serveurBDD, $userBDD, $mdpBDD, $nomBDD);

        // Use prepared statement para evitar SQL injection
        $requete = "DELETE FROM cr WHERE num = ?";
        $stmt = mysqli_prepare($connexion, $requete);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "i", $commentId);
            
            // Execute a declaração preparada
            if (mysqli_stmt_execute($stmt)) {
                // A exclusão foi bem-sucedida
                echo "Supprimé.";
            } else {
                // Trate erros, se necessário
                echo "Erreur a supprimer: " . mysqli_error($connexion);
            }

            mysqli_stmt_close($stmt);
        } else {
            // Trate erros de preparação da declaração, se necessário
            echo mysqli_error($connexion);
        }

        // Feche a conexão com o banco de dados
        mysqli_close($connexion);
    } else {
        // ID do comentário não fornecido
        echo "ID";
    }
} 
?>
