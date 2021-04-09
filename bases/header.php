<?php
    session_start();
?>


<!DOCTYPE html>
<html>
    <head>
        <title>Infinite Mesure</title>
        <link rel="stylesheet" href="/AutoKapt/CSS/styleBases.css" />
        <link rel="stylesheet" href="/AutoKapt/CSS/style.css" />
        <link rel="icon" href="/AutoKapt/favicon3.ico" type="image/x-icon" />
        <script src="https://kit.fontawesome.com/7f495e885c.js" crossorigin="anonymous"></script>
        <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

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
    <body>
        <header class="header">
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <div class="container-fluid">
                    <a class="navbar-brand" href="/AutoKapt/home.php"><img src="/AutoKapt/images/logo.png" class="logo" /></a>
                    <button
                        class="navbar-toggler"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#navbarNavDropdown"
                        aria-controls="navbarNavDropdown"
                        aria-expanded="false"
                        aria-label="Toggle navigation"
                    >
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNavDropdown">
                        <ul class="navbar-nav">
                            <li class="nav-item"><a class="nav-link" href="/AutoKapt/pages/User/reflex.php">Reflexe</a></li>
                            <li class="nav-item"><a class="nav-link" href="/AutoKapt/pages/User/stress.php">Stress</a></li>
                            <li class="nav-item"><a class="nav-link" href="/AutoKapt/pages/team.php">L'equipe</a></li>
<?php
                      if(isset($_SESSION["userUsername"])){
                        if($_SESSION["userAccess"] == 0){
                          echo 
                          '
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">' . $_SESSION["userUsername"] . '</a>
                                <ul class="dropdown-menu bg-dark">
                                    <li><a class="dropdown-item" href="/AutoKapt/pages/profile/myProfile.php">My profile</a></li>
                                    <li><a class="dropdown-item" href="/AutoKapt/pages/Admin/createManager.php">Create Manager</a></li>
                                    <li><a class="dropdown-item" href="/AutoKapt/pages/Admin/modifyFAQ.php">Update FAQ</a></li>
                                    <li><a class="dropdown-item" href="/AutoKapt/pages/profile/logOut.php">Log out</a></li>
                                </ul>
                            </li>';
                          
                        } 
                        else if($_SESSION["userAccess"] == 1){
                          echo 
                          '
                          <li class="nav-item dropdown">
                              <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">' . $_SESSION["userUsername"] . '</a>
                              <ul class="dropdown-menu bg-dark">
                                  <li><a class="dropdown-item" href="/AutoKapt/pages/profile/myProfile.php">My profile</a></li>
                                  <li><a class="dropdown-item" href="/AutoKapt/pages/Manager/createUser.php">Create User</a></li>
                                  <li><a class="dropdown-item" href="/AutoKapt/pages/profile/logOut.php">Log out</a></li>
                              </ul>
                          </li>';
                        } 
                        else if($_SESSION["userAccess"] == 2){
                          echo 
                          '
                          <li class="nav-item dropdown">
                              <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">' . $_SESSION["userUsername"] . '</a>
                              <ul class="dropdown-menu bg-dark">
                                  <li><a class="dropdown-item" href="/AutoKapt/pages/profile/myProfile.php">My profile</a></li>
                                  <li><a class="dropdown-item" href="/AutoKapt/pages/profile/logOut.php">Log out</a></li>
                              </ul>
                          </li>';
                        } 
                        else {
                          echo "<li class='nav-item'><a class='nav-link' href='/AutoKapt/pages/logIn/logIn.php'>Log in</a></li>";
                        }
                      }
?>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
      