<?php
  require_once($_SERVER['DOCUMENT_ROOT'].'/AutoKapt/bases/head.php');
?>
<body>
    <div id = "backgroundLogIn">
        <div id = "logo"><a href="/AutoKapt/home.php"><img src="/AutoKapt/images/logo.png" alt="logo"></a></div>
        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Repudiandae, blanditiis.</p>
    </div>
    <div class="right">
        <h4>Registration</h4>
        <div class="back"><a href="/AutoKapt/pages/logIn/logIn.php">Already have an account?</a></div>
        <form action="/AutoKapt/includes/logIn/signUp.inc.php" method="POST">
            <div class="element">
                <input type="text" name="username" required>
                <span></span>
                <label>Username</label>
            </div>
            <div class="element">
                <input type="email" name="email" required>
                <span></span>
                <label>Email</label>
            </div>
            <div class="element">
                <input type="password" name="password" required>
                <span></span>
                <label>Password</label>
            </div>
            <div class="element">
                <input type="password" name="pwdRepeat" required>
                <span></span>
                <label>Verify password</label> 
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
            <input type="submit" name="signUp-submit" value="Register">
        </form>
    

    <?php
require_once(__ROOT__.'includes/errors.inc.php');
    ?>
    
    </div>

</body>
</html>