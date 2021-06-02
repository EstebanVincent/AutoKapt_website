<?php
  require_once($_SERVER['DOCUMENT_ROOT'].'/AutoKapt/bases/head.php');
  if (!isset($_SESSION['userAccess'])){
    die(header("Location: /AutoKapt/home.php"));
}
if ($_SESSION['userAccess'] != 1 ){
    die(header("Location: /AutoKapt/home.php"));
}
?>
<body>
    <div id = "backgroundLogIn">
        <div id = "logo"><a href="/AutoKapt/home.php"><img src="/AutoKapt/images/logo.png" alt="logo"></a></div>
        <p><?php echo $lang['signup1'] ?></p>
    </div>
    <div class="right">
        <h4><?php echo $lang['créuser1'] ?></h4>
        <form action="/AutoKapt/includes/createAccount.inc.php" method="POST">
            <div class="element">
                <input type="email" name="email" required>
                <span></span>
                <label>Email</label>
            </div>
            <input type="submit" name="createUser-submit" value="Create Account">
        </form>
    

    <?php
require_once(__ROOT__.'includes/errors.inc.php');
    ?>
    
    </div>

</body>
</html>