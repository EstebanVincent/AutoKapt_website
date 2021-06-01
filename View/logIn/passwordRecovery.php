<?php
  require_once($_SERVER['DOCUMENT_ROOT'].'/AutoKapt/bases/head.php');
?>
<body id="backgroundLogIn">
        <div id = "logo"><a href="/AutoKapt/home.php"><img src="/AutoKapt/images/logo.png" alt="logo"></a></div>
        <p><?php echo $lang['oublimdp1'] ?></p>
   
    <div class="right">
        <h4><?php echo $lang['oublimdp2'] ?></h4>
        <p id="please"><?php echo $lang['oublimdp3'] ?></p>
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