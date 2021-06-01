<?php
  require_once($_SERVER['DOCUMENT_ROOT'].'/AutoKapt/bases/head.php');
  require_once __ROOT__.'Model/functions.inc.php';
?>
<body>
    <div id = "backgroundLogIn">
        <div id = "logo"><a href="/AutoKapt/home.php"><img src="/AutoKapt/images/logo.png" alt="logo"></a></div>
        <p><?php echo $lang['signup1'] ?></p>
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
                        <form action="/AutoKapt/includes/signUp.inc.php" method="POST">
                            <input type="hidden" name="selector" value="<?php echo $selector ?>">
                            <input type="hidden" name="validator" value="<?php echo $validator ?>">
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
                            <div class="element">
                                <input type="password" name="password-repeat" required>
                                <span></span>
                                <label><?php echo $lang['signup5'] ?></label>
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
                            <input type="submit" name="signUpManager-submit" value="Create Account">
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