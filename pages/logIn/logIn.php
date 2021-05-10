<?php
  require_once($_SERVER['DOCUMENT_ROOT'].'/AutoKapt/bases/head.php');
?>

<body>

    <div id = "backgroundLogIn">
        <div id = "logo"><a href="/AutoKapt/home.php"><img src="/AutoKapt/images/logo.png" alt="logo"></a></div>
        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Repudiandae, blanditiis.</p>
    <div id="logInContainer">
        <div class="right">
            <h4>Log in your account</h4>
            <form action="/AutoKapt/includes/logIn/logIn.inc.php" method="POST">
                <div class="element">
                    <input type="text" name="username" required>
                    <span></span>
                    <label>Username</label>
                </div>
                <div class="element">
                    <input type="password" name="password" required>
                    <span></span>
                    <label>Password</label>
                </div>
                <div class="forgot"><a href="/AutoKapt/pages/logIn/passwordRecovery.php">Forgot password?</a></div>
                <input type="submit" name="logIn-submit" value="Login">
                <div class="create"><a href="/AutoKapt/pages/logIn/signUpAdmin.php">Create Account</a></div>
            </form>

        <?php
            require_once(__ROOT__.'includes/errors.inc.php');
        ?>
        </div>
        </div>
    </div>
</body>
</html>