<?php
  require_once($_SERVER['DOCUMENT_ROOT'].'/AutoKapt/bases/head.php');
?>
<body>
    <div id = "backgroundLogIn">
        <div id = "logo"><a href="/AutoKapt/home.php"><img src="/AutoKapt/images/logo.png" alt="logo"></a></div>
        <p><?php echo $lang['signup1'] ?></p>
    </div>
    <div class="right">
        <h4><?php echo $lang['signup2'] ?></h4>
        <div class="back"><a href="/AutoKapt/View/logIn/logIn.php">Already have an account?</a></div>
        <form action="/AutoKapt/includes/logIn/signUp.inc.php" method="POST">
            <div class="element">
                <input type="text" name="username" required>
                <span></span>
                <label><?php echo $lang['login2'] ?></label>
            </div>
            <div class="element">
                <input type="email" name="email" required>
                <span></span>
                <label>Email</label>
            </div>
            <div class="element">
                <input type="password" name="password" required>
                <span></span>
                <label><?php echo $lang['login3'] ?></label>
            </div>
            <div class="element">
                <input type="password" name="pwdRepeat" required>
                <span></span>
                <label><?php echo $lang['verif-newmdp'] ?></label> 
            </div>
            <div class="element">
                <input list="gender" name="gender" required>
                <span></span>
                <label><?php echo $lang['signup3'] ?></label>
                <datalist id="gender">
                    <option value="Male">
                    <option value="Female">
                    <option value="Other">
                </datalist>
            </div>
            <div class="element">
                <input type="date" name="birth"required>
                <span></span>
                <label><?php echo $lang['signup4'] ?></label>
            </div>
            <input type="submit" name="signUp-submit" value="Register">
        </form>
    

    <?php
require_once(__ROOT__.'includes/errors.inc.php');
    ?>
    
    </div>

</body>
</html>