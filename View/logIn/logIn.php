<?php
  require_once($_SERVER['DOCUMENT_ROOT'].'/AutoKapt/bases/head.php');
?>

<body  id = "backgroundLogIn">

    <div id = "backgroundLogIn">
        <div id = "logo"><a href="/AutoKapt/home.php"><img src="/AutoKapt/images/logo.png" alt="logo"></a></div>
        <p><?php echo $lang['login6'] ?></p>
    <div id="logInContainer">
        <div class="right">
            <h4><?php echo $lang['login1'] ?></h4>
            <form action="/AutoKapt/includes/logIn/logIn.inc.php" method="POST">
                <div class="element">
                    <input type="text" name="username" required>
                    <span></span>
                    <label><?php echo $lang['login2'] ?></label>
                </div>
                <div class="element">
                    <input type="password" name="password" required>
                    <span></span>
                    <label><?php echo $lang['login3'] ?></label>
                </div>
                <div class="forgot"><a href="/AutoKapt/View/logIn/passwordRecovery.php"><?php echo $lang['login4'] ?></a></div>
                <input type="submit" name="logIn-submit" value="Login">

            </form>

        <?php
            require_once(__ROOT__.'includes/errors.inc.php');
        ?>
        </div>
        </div>
    </div>
</body>

</html>