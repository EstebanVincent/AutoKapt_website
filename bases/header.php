<!-- 
    fichier inclut dans tout les fichiers php vue par l'utilisateur
    contient head et donc config

    donc l'inclure dans les fichiers du dossier pages

    Il définit la barre de navigation adaptée
 -->
 <?php
    require_once "head.php";
?>
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

<?php
                      if(isset($_SESSION["userUsername"])){
                        if($_SESSION["userAccess"] == 0){
                          echo 
                          '
                            <li class="nav-item"><a class="nav-link" href="/AutoKapt/pages/User/dashboard.php">'. $lang["nav-dashboard"] .'</a></li>
                            <li class="nav-item"><a class="nav-link" href="/AutoKapt/pages/testpage.php">Tests</a></li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"><i class="fas fa-user"></i> ' . $_SESSION["userUsername"] . '</a>
                                <ul class="dropdown-menu bg-dark">
                                    <li><a class="dropdown-item" href="/AutoKapt/pages/profile/myProfile.php"><i class="fas fa-id-card"></i> '. $lang["nav-profile"] .'</a></li>
                                    <li><a class="dropdown-item" href="/AutoKapt/pages/Admin/createManager.php"><i class="fas fa-plus-circle"></i> '. $lang["nav-create-manager"] .'</a></li>
                                    <li><a class="dropdown-item" href="/AutoKapt/pages/Admin/modifyFAQ.php"><i class="far fa-question-circle"></i> '. $lang["nav-update-faq"] .'</a></li>
                                    <li><a class="dropdown-item" href="/AutoKapt/pages/Admin/modifyUsers.php?page=1&entries=20"><i class="fas fa-users"></i> '. $lang["nav-update-user"] .'</a></li>
                                    <li><a class="dropdown-item" href="/AutoKapt/pages/profile/logOut.php"><i class="fas fa-sign-out-alt"></i> '. $lang["nav-logout"] .'</a></li>
                                </ul>
                            </li>
                            ';
                          
                        } 
                        else if($_SESSION["userAccess"] == 1){
                          echo 
                          '
                          <li class="nav-item"><a class="nav-link" href="/AutoKapt/pages/User/dashboard.php">'. $lang["nav-dashboard"] .'</a></li>
                          <li class="nav-item"><a class="nav-link" href="/AutoKapt/pages/testpage.php">Tests</a></li>
                          <li class="nav-item dropdown">
                              <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"><i class="fas fa-user"></i> ' . $_SESSION["userUsername"] . '</a>
                              <ul class="dropdown-menu bg-dark">
                                  <li><a class="dropdown-item" href="/AutoKapt/pages/profile/myProfile.php"><i class="fas fa-id-card"></i> '. $lang["nav-profile"] .'</a></li>
                                  <li><a class="dropdown-item" href="/AutoKapt/pages/Manager/createUser.php"><i class="fas fa-plus-circle"></i> '. $lang["nav-create-user"] .'</a></li>
                                  <li><a class="dropdown-item" href="/AutoKapt/pages/profile/logOut.php"><i class="fas fa-sign-out-alt"></i> '. $lang["nav-logout"] .'</a></li>
                              </ul>
                          </li>
                          ';
                        } 
                        else if($_SESSION["userAccess"] == 2){
                          echo 
                          '
                          <li class="nav-item"><a class="nav-link" href="/AutoKapt/pages/User/dashboard.php">'. $lang["nav-dashboard"] .'</a></li>
                          <li class="nav-item"><a class="nav-link" href="/AutoKapt/pages/testpage.php">Tests</a></li>
                          <li class="nav-item dropdown">
                              <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"><i class="fas fa-user"></i> ' . $_SESSION["userUsername"] . '</a>
                              <ul class="dropdown-menu bg-dark">
                                  <li><a class="dropdown-item" href="/AutoKapt/pages/profile/myProfile.php"><i class="fas fa-id-card"></i> '. $lang["nav-profile"] .'</a></li>
                                  <li><a class="dropdown-item" href="/AutoKapt/pages/profile/logOut.php"><i class="fas fa-sign-out-alt"></i> '. $lang["nav-logout"] .'</a></li>
                              </ul>
                          </li>
                          ';
                        } 
                      } else {
                        echo
                        ' 
                            <li class="nav-item"><a class="nav-link" href="/AutoKapt/pages/testpage.php">Tests</a></li>
                            <li class="nav-item"><a class="nav-link" href="/AutoKapt/pages/logIn/logIn.php">'. $lang["nav-login"] .'</a></li>
                            ';
                      }
?>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>