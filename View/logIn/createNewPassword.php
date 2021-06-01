<?php
  require_once($_SERVER['DOCUMENT_ROOT'].'/AutoKapt/bases/head.php');
?>
<body>
    <div id = "backgroundLogIn">
        <div id = "logo"><a href="/AutoKapt/home.php"><img src="/AutoKapt/images/logo.png" alt="logo"></a></div>
        <p><?php echo $lang['creermdp'] ?></p>
    </div>
    <div class="right">
        <?php
            $selector = $_GET["selector"];
            $validator = $_GET["validator"];

            if(empty($selector) || empty($validator)){
                echo'no selector';
            } else {
                if(ctype_xdigit($selector) !== false && ctype_xdigit($validator) !== false){
                    ?>
                    <form action="/AutoKapt/includes/logIn/createNewPassword.inc.php" method="POST">
                        <input type="hidden" name="selector" value="<?php echo $selector ?>">
                        <input type="hidden" name="validator" value="<?php echo $validator ?>">
                        <div class="element">
                            <input type="password" name="password" required>
                            <span></span>
                            <label><?php echo $lang['new-mdp'] ?></label>
                        </div>
                        <div class="element">
                            <input type="password" name="password-repeat" required>
                            <span></span>
                            <label><?php echo $lang['signup5'] ?></label>
                        </div>
                        <input type="submit" name="createNewPassword-submit" value="Reset password">
                    </form>
                    <?php
                }
            }
        ?>
        
        <?php
        require_once(__ROOT__.'includes/errors.inc.php');
        ?>
    </div>

    
</body>
</html>