<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Sign In | AutoKapt</title>
        <link rel="stylesheet" href="/AutoKapt/style.css">
    </head>
<body>
    <div id = "backgroundLogIn">
        <div id = "logo"><a href="/AutoKapt/home.php"><img src="/AutoKapt/images/logo.png" alt="logo"></a></div>
        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Repudiandae, blanditiis.</p>
    </div>
    <div class="right">
        <h4>Log in your account</h4>
        <form action="/AutoKapt/includes/logIn.inc.php" method="POST">
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
            <input type="submit" name="submit" value="Login">
            <div class="create"><a href="/AutoKapt/pages/logIn/signUp.php">Create Account</a></div>
        </form>

    <?php
        $pathErrors = $_SERVER['DOCUMENT_ROOT'];
        $pathErrors .= '/AutoKapt/includes/errors.inc.php'; /* psq le / va voir la vrai root d'ou cette méthode */
        include_once($pathErrors);
    ?>

    </div>
</body>
</html>