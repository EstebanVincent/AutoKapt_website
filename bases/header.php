<?php
    session_start();
?>


<!DOCTYPE html>
<html>

<head>
  <title>AutoKapt</title>
  <link rel="stylesheet" href="/AutoKapt/style.css">
</head>

<body>
  <header>
    <nav>
      <ul>
        <li id="name"><a href="/AutoKapt/home.php">AutoKapt</a></li>
        <?php
        if(isset($_SESSION["userUsername"])){
          echo '<li><a href="/AutoKapt/">Profile</a></li>';/* Menu déroulant a faire */
        }
        else {
          echo '<li><a href="/AutoKapt/pages/logIn/logIn.php">Log in</a></li>';
        }
        ?>
        
        <li class="scroll"><a href="#">Langue</a>
          <ul class="sous">
            <li><a href="#">English</a></li>
            <li><a href="#">Français</a></li>
          </ul>
        </li>
        <li><a href="/AutoKapt/pages/faq.php">FAQ</a></li>
        <li><a href="/AutoKapt/pages/team.php">L'équipe</a></li>
      </ul>
    </nav>
    <div id="navbar"></div>