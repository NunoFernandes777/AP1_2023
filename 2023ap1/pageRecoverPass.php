<?php
session_start();
include '_conf.php';


if ($connexion = mysqli_connect($serveurBDD, $userBDD, $mdpBDD, $nomBDD)) {

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $username = $_POST['username'];
        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['confirm_password'];


        if ($new_password != $confirm_password) {
            echo "mot de passe ne correspond pas.";
        } else {

            $query = "SELECT * FROM utilisateur WHERE login = '$username'";
            $result = mysqli_query($connexion, $query);


            if (mysqli_num_rows($result) == 1) {

                $hashed_password = md5($new_password);
                $update_query = "UPDATE utilisateur SET motdepasse = '$hashed_password' WHERE login = '$username'";
                if (mysqli_query($connexion, $update_query)) {
                    echo "Mot de passe mis a jour";
                } else {
                    echo "erreur mise a jour du mot de passe: " . mysqli_error($connexion);
                }
            } else {
                echo "Login inconnue";
            }
        }
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
</head>

<body>
    <h1>Reset Password</h1>
    <form method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>

        <label for="new_password">New Password:</label>
        <input type="password" id="new_password" name="new_password" required>

        <label for="confirm_password">Confirm Password:</label>
        <input type="password" id="confirm_password" name="confirm_password" required>

        <button type="submit">Reset Password</button>
    </form>


</body>

</html>