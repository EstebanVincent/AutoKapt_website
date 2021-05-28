<!-- 
    fichier inclut dans tout les fichiers php vue par l'utilisateur
    contient config
    il est inclu de base dans header

    donc l'inclure dans les fichiers de forms log In

    Il définit le head du HTML avec les différentes libraries utilisées
 -->
<?php
    require_once "config.php";
?>


<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Infinite Mesure</title>
        <link rel="stylesheet" href="/AutoKapt/CSS/styleBases.css" />
        <link rel="stylesheet" href="/AutoKapt/CSS/style.css" />
        <link rel="stylesheet" href="/AutoKapt/CSS/styleForms.css" />
        <link rel="icon" href="/AutoKapt/favicon.ico" type="image/x-icon" />
        <!-- Font Awesome -->
        <script src="https://kit.fontawesome.com/7f495e885c.js" crossorigin="anonymous"></script>

        <!-- CanvasJs -->
        <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

        <!-- jQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <!-- jQuery-Confirm -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>

        <!-- Bootstrap 5 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6"
            crossorigin="anonymous"
        />
        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf"
            crossorigin="anonymous"
        ></script>
    </head>