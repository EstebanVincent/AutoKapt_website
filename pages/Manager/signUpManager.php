<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>AutoKapt</title>
        <link rel="stylesheet" href="/AutoKapt/style.css">
        <link rel="icon" href="/AutoKapt/favicon3.ico" type="image/x-icon" />
    </head>
<body>
    <div id = "backgroundLogIn">
        <div id = "logo"><a href="/AutoKapt/home.php"><img src="/AutoKapt/images/logo.png" alt="logo"></a></div>
        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Repudiandae, blanditiis.</p>
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
                            <label>Username</label>
                        </div>
                        <div class="element">
                            <input type="password" name="password" required>
                            <span></span>
                            <label>New password</label>
                        </div>
                        <div class="element">
                            <input type="password" name="password-repeat" required>
                            <span></span>
                            <label>Confirm Pwd</label>
                        </div>
                        <div class="element">
                            <input list="gender" name="gender" required>
                            <span></span>
                            <label>Gender</label>
                              <datalist id="gender">
                                <option value="Male">
                                <option value="Female">
                                <option value="Other">
                              </datalist>
                        </div>
                        <div class="element">
                            <input type="date" name="birth"required>
                            <span></span>
                            <label>Date of birth</label>
                        </div>
                        <input type="submit" name="signUpManager-submit" value="Create Account">
                    </form>
                    <?php
                }
            }
        ?>
        
        <?php
        $pathErrors = $_SERVER['DOCUMENT_ROOT'];
        $pathErrors .= '/AutoKapt/includes/errors.inc.php'; /* psq le / va voir la vrai root d'ou cette méthode */
        include_once($pathErrors);
        ?>
    </div>

    
</body>
</html>