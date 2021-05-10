<?php
  require_once($_SERVER['DOCUMENT_ROOT'].'/AutoKapt/bases/head.php');
?>
<body>
    <div id = "backgroundLogIn">
        <div id = "logo"><a href="/AutoKapt/home.php"><img src="/AutoKapt/images/logo.png" alt="logo"></a></div>
        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Repudiandae, blanditiis.</p>
    </div>
    <div class="right">
        <h4>Forgot your password?</h4>
        <p id="please">Please enter your account's registered email adress and we'll send you a recovery email.</p>
        <form action="/AutoKapt/includes/logIn/passwordRecovery.inc.php" method="POST">
            <div class="element">
                <input type="email" name="email" required>
                <span></span>
                <label>Email</label>
            </div>
            <input type="submit" name="password-recovery-submit" value="Send email">
        </form>
        <?php
        require_once(__ROOT__.'includes/errors.inc.php');
        ?>

    </div>
</body>
</html>