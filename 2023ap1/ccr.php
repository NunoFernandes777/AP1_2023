<?php
session_start();
include '_conf.php';
require("header/header.php");
?>
<html>

<div class="form_ccr">

    <form method="post" action="cr.php" > 

        <table class="table_ccr">

            <tr>
                <th>
                    <a class="title_ccr">Créer un compte rendu</a>
                </th>
            <tr>
            <tr>
                <td>
                    <a class="letter_ccr">Date</a> <br> <input class="date" type="date" name="date" required>
                </td>
            </tr>
            <tr>
                <td>
                    <a class="letter_ccr">Contenu</a> 
                </td>
            </tr>
            <tr>
                <td>
                    <textarea name="contenu" rows=20 cols=70 class="textarea_ccr"></textarea>
                </td>
            </tr>
            <tr>
                <td>
                    <button type="submit" name="update" class="btn_confirmer"> Confirmer </button>
                </td>
            </tr>

        </table> 

    </form> 

</div>
</html>

<style>
.form_ccr{
    margin: auto;
    width: 50%;
    margin-top: 50px;
    text-align: center;
}

.title_ccr{
    font-size: 35px;
}

.letter_ccr{
    font-size: 20px;
}

.table_ccr{
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.75);
    margin: auto;
    max-width: 500px;
    padding: 10px;
}

.table_ccr td{
    padding: 10px;
}

.btn_confirmer{
    
    width: 100%;
    height: 100%;
    border-radius: 3px;
    border: none;
    background: transparent;
    font-family: serif;
    font-size: 17px;

}

.btn_confirmer:hover {
    cursor: pointer;
}

.date{
    background: transparent;
    border: 2px solid black;
    border-radius: 5px;
}

.textarea_ccr{
    border: 2px solid black;
    border-radius: 5px;
    padding: 15px;
    outline: none;
    background: transparent;
}

</style>
