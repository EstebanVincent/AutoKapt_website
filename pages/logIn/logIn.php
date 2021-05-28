<?php
  require_once($_SERVER['DOCUMENT_ROOT'].'/AutoKapt/bases/head.php');
?>

<body  id = "backgroundLogIn">

<div id="pageContainer">
    <div class="align-middle">
        <div class="d-flex justify-content-around">
            <a  href="/AutoKapt/home.php"><img src="/AutoKapt/images/logo.png" alt="logo"></a>
            <div id="logInContainer">
                <h4>Log in your account</h4>
                <form action="/AutoKapt/includes/logIn/logIn.inc.php" method="POST">
                    <div class="element">
                        <input type="text" placeholder="Username" name="username" required >
                        <span></span>   
                    </div>
                    <div class="element">
                        <input type="password" placeholder="Password" name="password" required>
                        <span></span>
                    </div>
                    <div class="aligne">
                        <div class="forgot"><a  href="/AutoKapt/pages/logIn/passwordRecovery.php">Forgot password?</a>
                        </div>
                        <input type="submit" name="logIn-submit" value="Log In" id="logInButton">
                        <div class="create"><a href="/AutoKapt/pages/logIn/signUpAdmin.php">Create Account</a>
                        </div>
                    </div>
                </form>
                    <?php
                    require_once(__ROOT__.'includes/errors.inc.php');?>
            </div>
        </div>
    </div>
</body>

</html>