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
    <h4>Verify password</h4>
      <div class="element">
        <input type="password" name="verifyPassword" required>
        <span></span>
        <label>Verify password</label>
      </div>
    <h4>Insert new username</h4>
      <div class="element">
        <input type="text" name="newUsername" required>
        <span></span>
        <label>New username</label>
      </div>
      <div class="element">
        <input type="text" name="verifyNewUsername" required>
        <span></span>
        <label>Verify new username</label>
      </div>
    <input type="submit" name="change-username-submit" value="Update username">
  </form>
</div>

<?php
  require_once(__ROOT__.'includes/errors.inc.php');
  require_once(__ROOT__.'bases/footer.php');