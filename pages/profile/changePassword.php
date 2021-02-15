<?php
  $pathHeader = $_SERVER['DOCUMENT_ROOT'];
  $pathHeader .= '/AutoKapt/bases/header.php'; /* psq le / va voir la vrai root d'ou cette méthode */
  include_once($pathHeader);
?>
<div class="left">
  <ul>
    <li><a href="#"><h4>Security and Privacy</h4></a></li>
    <ul>
      <li><a href="/AutoKapt/pages/profile/changeUsername.php">Change username</a></li>
      <li><a href="/AutoKapt/pages/profile/changeEmail.php">Change email</a></li>
      <li><a href="/AutoKapt/pages/profile/changePassword.php">Change password</a></li>
      <li><a href="/AutoKapt/pages/profile/deleteAccount.php">Delete account</a></li>
    </ul>
  </ul>
</div>

<div class="right">
  <form action="/AutoKapt/includes/profile/change.inc.php" method="POST">
    <h4>Current password</h4>
      <div class="element">
        <input type="password" name="currentPassword" required>
        <span></span>
        <label>Current password</label>
      </div>
    <h4>Insert new password</h4>
      <div class="element">
        <input type="password" name="newPassword" required>
        <span></span>
        <label>New password</label>
      </div>
      <div class="element">
        <input type="password" name="verifyNewPassword" required>
        <span></span>
        <label>Verify new password</label>
      </div>
    <input type="submit" name="change-password-submit" value="Update password">
  </form>
  <?php
        $pathErrors = $_SERVER['DOCUMENT_ROOT'];
        $pathErrors .= '/AutoKapt/includes/errors.inc.php'; /* psq le / va voir la vrai root d'ou cette méthode */
        include_once($pathErrors);
    ?>
</div>
<?php
  $pathFooter = $_SERVER['DOCUMENT_ROOT'];
  $pathFooter .= '/AutoKapt/bases/footer.php';/* psq le / va voir la vrai root d'ou cette méthode */
  include_once($pathFooter);