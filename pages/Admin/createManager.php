<?php
  $pathHeader = $_SERVER['DOCUMENT_ROOT'];
  $pathHeader .= '/AutoKapt/bases/header.php'; /* psq le / va voir la vrai root d'ou cette méthode */
  include_once($pathHeader);
?>

    <div id = "backgroundLogIn">
        <div id = "logo"><a href="/AutoKapt/home.php"><img src="/AutoKapt/images/logo.png" alt="logo"></a></div>
        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Repudiandae, blanditiis.</p>
    </div>
    <div class="right">
        <h4>Create a Manager</h4>
        <form action="/AutoKapt/includes/createAccount.inc.php" method="POST">
            <div class="element">
                <input type="email" name="email" required>
                <span></span>
                <label>Email</label>
            </div>
            <input type="submit" name="createManager-submit" value="Create Account">
        </form>
    

    <?php
        $pathErrors = $_SERVER['DOCUMENT_ROOT'];
        $pathErrors .= '/AutoKapt/includes/errors.inc.php'; /* psq le / va voir la vrai root d'ou cette méthode */
        include_once($pathErrors);
    ?>
    
    </div>

<?php
$pathErrors = $_SERVER['DOCUMENT_ROOT'];
$pathErrors .= '/AutoKapt/includes/errors.inc.php'; /* psq le / va voir la vrai root d'ou cette méthode */
include_once($pathErrors);

$pathFooter = $_SERVER['DOCUMENT_ROOT'];
$pathFooter .= '/AutoKapt/bases/footer.php';/* psq le / va voir la vrai root d'ou cette méthode */
include_once($pathFooter);
?>