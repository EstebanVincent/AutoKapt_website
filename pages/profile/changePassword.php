<?php
  require_once($_SERVER['DOCUMENT_ROOT'].'/AutoKapt/bases/header.php');
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
</div>
<?php
  require_once(__ROOT__.'includes/errors.inc.php');
  require_once(__ROOT__.'bases/footer.php');