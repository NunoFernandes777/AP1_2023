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
    <link href="style.css" media="all" rel="stylesheet" type="text/css" />
    <title>Reset Password</title>
</head>

<body>
    <div class="designIndexbox"> 
        <form method="post">
            <div class="textDesign">
            <h1>Reset Password</h1>
                <table class="table_loggin">
                    <tr>
                        <td>
                            <label for="username" class="text_style">Username:</label>
                        </td>
                        <td>
                            <input type="text" id="username" name="username" class="input_style" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="new_password" class="text_style">New Password:</label>
                        </td>
                        <td>
                            <input type="password" id="new_password" name="new_password" class="input_style" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="confirm_password" class="text_style">Confirm Password:</label>
                        </td>
                        <td>
                            <input type="password" id="confirm_password" name="confirm_password" class="input_style" required>
                        </td>
                    </tr>
                </table>
                <button type="submit" class="buttonReset">Reset Password</button>
            </div>
        </form>
    </div>
</body>

</html>

<style>
    html,
    body {
        margin: 0;
        height: 100%;
    }

    body {
        background-image: linear-gradient(to right bottom, #ffbbe1, #efb6e5, #dbb1e9, #c5aeeb, #acabeb, #9bb3f1, #8bbaf3, #7dc1f3, #80d2f7, #8de2f9, #a1f1f9, #b9fffa);
        font-family: 'Poppins', sans-serif;
    }

    .buttonReset {

        width: 125px;
        margin: auto;
        margin-top: 20px;
        background-color: transparent;
        border: 2px solid black;
        height: 25px;
        border-radius: 10px;
        cursor: pointer;

    }

    .text_style {

        font-size: 18px;

    }

    .input_style {

        border: none;
        padding: 5px;
        outline: none;
        height: 20px;
        border-radius: 10px;

    }
</style>