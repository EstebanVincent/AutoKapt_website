<?php
  require_once($_SERVER['DOCUMENT_ROOT'].'/AutoKapt/bases/header.php');
?>

<div class="container-fluid bg-secondary text-white-50">
	<div class="py-3"></div>
	<section class="dark2 py-2 mx-5 rounded">
		<h2>Personal Information</h2>
    <p>Username = Test</p>
    <p>Email = Lorem ipsum dolor sit amet.</p>
    <p>Gender = Male</p>
    <p>Age = 22 years</p>
  </section>
  <div class="py-3"></div>
  <div class="row">
    <!-- prend la moitié de l'écran -->
    <div class="col-6 text-center"> 
      <section class="dark2 py-2 ms-5 me-2 rounded">
        <h2>Settings</h2>
        <div class="list-group mx-5">
          <button id="changeUsername" class="list-group-item list-group-item-action btn bg-secondary">Change username</button>
          <button id="changeEmail" class="list-group-item list-group-item-action btn bg-secondary">Change email</button>
          <button id="changePassword" class="list-group-item list-group-item-action btn bg-secondary">Change password</button>
          <button id="deleteAccount" class="list-group-item list-group-item-action btn bg-secondary">Delete account</button>
        </div>
      </section>
    </div>
    <!-- prend un tier de l'écran -->
    <div class="col-4 text-center mx-auto hidden" id="username">
        <form class="dark2 py-2 ms-2 me-5 rounded text-white-50" action="/AutoKapt/includes/profile/change.inc.php" method="POST">
          <h2>Change username</h2>
          <h4>Verify password</h4>
          <div class="element">
            <input class="text-white-50" type="password" name="verifyPassword" required>
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
          <input class="btn btn-info" type="submit" name="change-username-submit" value="Update username">
        </form>
    </div>
    <!-- prend un tier de l'écran -->
    <div class="col-4 text-center mx-auto hidden" id="email">
        <form class="dark2 py-2 ms-2 me-5 rounded text-white-50" action="/AutoKapt/includes/profile/change.inc.php" method="POST">
          <h2>Change Email</h2>
          <h4>Verify password</h4>
          <div class="element">
            <input class="text-white-50" type="password" name="verifyPassword" required>
            <span></span>
            <label>Verify password</label>
          </div>
          <h4>Insert new email</h4>
          <div class="element">
            <input type="text" name="newEmail" required>
            <span></span>
            <label>New email</label>
          </div>
          <div class="element">
            <input type="text" name="verifyNewEmail" required>
            <span></span>
            <label>Verify new email</label>
          </div>
          <input class="btn btn-info" type="submit" name="change-email-submit" value="Update username">
        </form>
    </div>
    <!-- prend un tier de l'écran -->
    <div class="col-4 text-center mx-auto hidden" id="password">
        <form class="dark2 py-2 ms-2 me-5 rounded text-white-50" action="/AutoKapt/includes/profile/change.inc.php" method="POST">
          <h2>Change Password</h2>
          <h4>Verify password</h4>
          <div class="element">
            <input class="text-white-50" type="password" name="verifyPassword" required>
            <span></span>
            <label>Verify password</label>
          </div>
          <h4>Insert new password</h4>
          <div class="element">
            <input type="text" name="newPassword" required>
            <span></span>
            <label>New password</label>
          </div>
          <div class="element">
            <input type="text" name="verifyNewPassword" required>
            <span></span>
            <label>Verify new password</label>
          </div>
          <input class="btn btn-info" type="submit" name="change-password-submit" value="Update username">
        </form>
    </div>
    <!-- prend un tier de l'écran -->
    <div class="col-4 text-center mx-auto hidden" id="delete">
        <form class="dark2 py-2 ms-2 me-5 rounded text-danger" action="/AutoKapt/includes/profile/change.inc.php" method="POST">
          <h2>Delete Account</h2>
          <h4>Verify password</h4>
          <div class="element">
            <input class="text-danger" type="password" name="verifyPassword" required>
            <span></span>
            <label>Verify password</label>
          </div>
          <p>Are you sure u want to delete your account ?</p>
          <input class="btn btn-danger" type="submit" name="delete-account-submit" value="Delete Account">
        </form>
    </div>
  </div>
  <div class="py-3"></div>
</div>
<!-- rend visible ou non une form à la fois avec click sur bouton corespondant -->
<script>
$('#changeEmail').click(function() {
  $('#delete').hide();
  $('#password').hide();
  $('#username').hide();
  $('#email').toggle();
});
$('#changePassword').click(function() {
  $('#delete').hide();
  $('#email').hide();
  $('#username').hide();
  $('#password').toggle();
});
$('#changeUsername').click(function() {
  $('#delete').hide();
  $('#password').hide();
  $('#email').hide();
  $('#username').toggle();
});
$('#deleteAccount').click(function() {
  $('#password').hide();
  $('#email').hide();
  $('#username').hide();
  $('#delete').toggle();
});
</script>
<?php
require_once(__ROOT__.'bases/footer.php');
?>