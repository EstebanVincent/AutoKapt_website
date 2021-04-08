<?php
    session_start();
?>


<!DOCTYPE html>
<html>

<head>
  <title>Infinite Mesure</title>
  <link rel="stylesheet" href="/AutoKapt/style.css">
  <link rel="icon" href="/AutoKapt/favicon3.ico" type="image/x-icon" />
  <script src="https://kit.fontawesome.com/7f495e885c.js" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

  <!-- <link rel="stylesheet" href="https://unpkg.com/ionicons@5.5.10-0/dist/css/ionicons.min.css"> -->
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
            echo '<li class="hover"><a href="/AutoKapt/pages/profile/myProfile.php">My profile</a></li>';
            echo '<li class="hover"><a href="/AutoKapt/pages/Admin/createManager.php">Create Manager</a></li>';
            echo '<li class="hover"><a href="/AutoKapt/pages/Admin/modifyFAQ.php">Update FAQ</a></li>';
            echo '<li class="hover"><a href="/AutoKapt/pages/profile/logOut.php">Log out</a></li>';
          echo'</ul>';
          echo '</li>';
          } 
          else if ($_SESSION["userAccess"] == 1){
            echo '<li class="hover scroll"><a href="#">' . $_SESSION["userUsername"] . '</a>';
            echo '<ul class="sous">';
            echo '<li class="hover"><a href="/AutoKapt/pages/Manager/createUser.php">Create user</a></li>';
            echo '<li class="hover"><a href="/AutoKapt/pages/profile/myProfile.php">My profile</a></li>';
            echo '<li class="hover"><a href="/AutoKapt/pages/profile/logOut.php">Log out</a></li>';
            echo'</ul>';
            echo '</li>';
          }
          else if ($_SESSION["userAccess"] == 2){
            echo '<li class="hover scroll"><a href="#">' . $_SESSION["userUsername"] . '</a>';
                echo '<ul class="sous">';
                    echo '<li class="hover"><a href="/AutoKapt/pages/profile/myProfile.php">My profile</a></li>';
                    echo '<li class="hover"><a href="/AutoKapt/pages/profile/logOut.php">Log out</a></li>';
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
            <li><a href="/AutoKapt/includes/language/change2English.php">English</a></li>
            <li><a href="/AutoKapt/includes/language/change2French.php">Français</a></li>
          </ul>
        </li>
        <li class="hover"><a href="/AutoKapt/pages/faq.php">FAQ</a></li>
        <li class="hover"><a href="/AutoKapt/pages/team.php">L'équipe</a></li>
        <li class="hover"><a href="/AutoKapt/pages/User/stress.php">Stress</a></li>
        <li><input  type="search" class="searchTerm" placeholder="Search">
        </li>
        
      </ul>
    </nav>
    <div id="navbar"></div>