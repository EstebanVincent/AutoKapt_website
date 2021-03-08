<?php
    session_start();
?>


<!DOCTYPE html>
<html>

<head>
  <title>Infinite Mesure</title>
  <link rel="stylesheet" href="/AutoKapt/style.css">
  <link rel="icon" href="/AutoKapt/favicon3.ico" type="image/x-icon" />
</head>

<body>
  <header>
    <nav>
      <ul>
        <li class="hover" id="name"><a href="/AutoKapt/home.php">Infinite Mesure</a></li>
        <?php
        if(isset($_SESSION["userUsername"])){
          if($_SESSION["userAccess"] == 0){
            echo '<li class="hover scroll"><a href="#">' . $_SESSION["userUsername"] . '</a>';
                    echo '<ul class="sous">';
            echo '<li class="hover"><a href="/AutoKapt/pages/Admin/createManager.php">Create Manager</a></li>';
            echo '<li class="hover"><a href="/AutoKapt/pages/profile/logOut.php">Log out</a></li>';
            /* echo '<li><a href="/AutoKapt/pages/logIn/createNewPassword.php">New password</a></li>'; */ /* ne fonctionne pas car ducoup pas de token comme ça */
          echo'</ul>';
          echo '</li>';
          } 
          else if ($_SESSION["userAccess"] == 1){
            echo '<li class="hover scroll"><a href="#">' . $_SESSION["userUsername"] . '</a>';
            echo '<ul class="sous">';
            echo '<li class="hover"><a href="/AutoKapt/pages/Manager/createUser.php">Create user</a></li>';
            echo '<li class="hover"><a href="/AutoKapt/pages/profile/logOut.php">Log out</a></li>';
            /* echo '<li><a href="/AutoKapt/pages/logIn/createNewPassword.php">New password</a></li>'; */ /* ne fonctionne pas car ducoup pas de token comme ça */
            echo'</ul>';
            echo '</li>';
          }
          else if ($_SESSION["userAccess"] == 2){
            echo '<li class="hover scroll"><a href="#">' . $_SESSION["userUsername"] . '</a>';
                    echo '<ul class="sous">';
            echo '<li class="hover"><a href="/AutoKapt/pages/profile/logOut.php">Log out</a></li>';
            /* echo '<li><a href="/AutoKapt/pages/logIn/createNewPassword.php">New password</a></li>'; */ /* ne fonctionne pas car ducoup pas de token comme ça */
          echo'</ul>';
          echo '</li>';
          }
        }
        else {
          echo '<li class="hover"><a href="/AutoKapt/pages/logIn/logIn.php">Log in</a></li>';
        }
        ?>
        <li class="hover scroll"><a href="#">Langue</a>
          <ul class="sous">
            <li><a href="#">English</a></li>
            <li><a href="#">Français</a></li>
          </ul>
        </li>
        <li class="hover"><a href="/AutoKapt/pages/faq.php">FAQ</a></li>
        <li class="hover"><a href="/AutoKapt/pages/team.php">L'équipe</a></li>
        <li><input  type="search" class="searchTerm" placeholder="Search">
        </li>
        
      </ul>
    </nav>
    <div id="navbar"></div>