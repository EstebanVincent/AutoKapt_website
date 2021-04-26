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
                            <li class="nav-item"><a class="nav-link" href="/AutoKapt/pages/User/dashboard.php">Dashboard</a></li>
                            <li class="nav-item"><a class="nav-link" href="/AutoKapt/pages/team.php">L'équipe</a></li>

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
                                    <li><a class="dropdown-item" href="/AutoKapt/pages/Admin/modifyUsers.php">Update users</a></li>
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
                      } else {
                        echo' <li class="nav-item"><a class="nav-link" href="/AutoKapt/pages/testpage.php">Tests</a></li>
                              <li class="nav-item"><a class="nav-link" href="/AutoKapt/pages/logIn/logIn.php">Log in</a></li>';
                      }
?>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
      