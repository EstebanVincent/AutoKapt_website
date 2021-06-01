<?php
  require_once($_SERVER['DOCUMENT_ROOT'].'/AutoKapt/bases/header.php');
  require_once __ROOT__.'Model/functions.inc.php';
  $array = getInfo($conn, $_SESSION['userId'])[0];
?>

<div class="container-fluid bg-secondary text-white-50">
	<div class="py-3"></div>
	<section class="dark2 py-2 mx-5 rounded">
    <div class="ms-3">
      <h2> <?php echo $lang['profile1'] ?> </h2>
      <p> <?php echo $lang['profile-username'].$_SESSION['userUsername'] ?></p>
      <p> <?php echo $lang['profile-email'].$array['usersEmail'] ?> </p>
      <p> <?php echo $lang['profile-genre'].$array['usersGender'] ?> </p>
      <p> <?php echo $lang['profile-age'].$array['usersBirth'] ?> </p>
    </div>
  </section>
  <div class="py-3"></div>
  <div class="row">
    <!-- prend la moitié de l'écran -->
    <div class="col-6 text-center"> 
      <section class="dark2 py-2 ms-5 me-2 rounded">
        <h2> <?php echo $lang['profile-para'] ?> </h2>
        <div class="list-group mx-5">
          <button id="changeUsername" class="list-group-item list-group-item-action btn bg-secondary"> <?php echo $lang['change-user'] ?> </button>
          <button id="changeEmail" class="list-group-item list-group-item-action btn bg-secondary"> <?php echo $lang['change-mail'] ?> </button>
          <button id="changePassword" class="list-group-item list-group-item-action btn bg-secondary"> <?php echo $lang['change-mdp'] ?> </button>
          <button id="deleteAccount" class="list-group-item list-group-item-action btn bg-secondary"> <?php echo $lang['supp-compte'] ?> </button>
        </div>
      </section>
    </div>
    <!-- prend un tier de l'écran -->
    <div class="col-4 text-center mx-auto hidden" id="username">
        <form class="dark2 py-2 ms-2 me-5 rounded text-white-50" action="/AutoKapt/includes/profile/change.inc.php" method="POST">
          <h2> <?php echo $lang['change-user'] ?> </h2>
          <h4> <?php echo $lang['verif-mdp'] ?> </h4>
          <div class="element">
            <input class="text-white-50" type="password" name="verifyPassword" required>
            <span></span>
            <label> <?php echo $lang['verif-mdp'] ?> </label>
          </div>
          <h4> <?php echo $lang['Insert-user'] ?> </h4>
          <div class="element">
            <input type="text" name="newUsername" required>
            <span></span>
            <label><?php echo $lang['new-user'] ?></label>
          </div>
          <div class="element">
            <input type="text" name="verifyNewUsername" required>
            <span></span>
            <label> <?php echo $lang['verif-newuser'] ?> </label>
          </div>
          <input class="btn btn-info" type="submit" name="change-username-submit" value="Update username">
        </form>
    </div>
    <!-- prend un tier de l'écran -->
    <div class="col-4 text-center mx-auto hidden" id="email">
        <form class="dark2 py-2 ms-2 me-5 rounded text-white-50" action="/AutoKapt/includes/profile/change.inc.php" method="POST">
          <h2> <?php echo $lang['change-mail'] ?></h2>
          <h4> <?php echo $lang['verif-mdp'] ?> </h4>
          <div class="element">
            <input class="text-white-50" type="password" name="verifyPassword" required>
            <span></span>
            <label> <?php echo $lang['verif-mdp'] ?> </label>
          </div>
          <h4> <?php echo $lang['insert-mail'] ?> </h4>
          <div class="element">
            <input type="text" name="newEmail" required>
            <span></span>
            <label> <?php echo $lang['new-mail'] ?> </label>
          </div>
          <div class="element">
            <input type="text" name="verifyNewEmail" required>
            <span></span>
            <label> <?php echo $lang['verif-mail'] ?></label>
          </div>
          <input class="btn btn-info" type="submit" name="change-email-submit" value="Update Email">
        </form>
    </div>
    <!-- prend un tier de l'écran -->
    <div class="col-4 text-center mx-auto hidden" id="password">
        <form class="dark2 py-2 ms-2 me-5 rounded text-white-50" action="/AutoKapt/includes/profile/change.inc.php" method="POST">
          <h2> <?php echo $lang['change-mdp'] ?></h2>
          <h4> <?php echo $lang['verif-mdp'] ?></h4>
          <div class="element">
            <input class="text-white-50" type="password" name="verifyPassword" required>
            <span></span>
            <label> <?php echo $lang['verif-mdp'] ?></label>
          </div>
          <h4><?php echo $lang['insert-mdp'] ?></h4>
          <div class="element">
            <input name="newPassword" type="password" required>
            <span></span>
            <label> <?php echo $lang['new-mdp'] ?> </label>
          </div>
          <div class="element">
            <input name="verifyNewPassword" type="password" required>
            <span></span>
            <label> <?php echo $lang['verif-newmdp'] ?> </label>
          </div>
          <input class="btn btn-info" type="submit" name="change-password-submit" value="Update Password">
        </form>
    </div>
    <!-- prend un tier de l'écran -->
    <div class="col-4 text-center mx-auto hidden" id="delete">
        <form class="dark2 py-2 ms-2 me-5 rounded text-danger" action="/AutoKapt/includes/profile/change.inc.php" method="POST">
          <h2> <?php echo $lang['supp-compte'] ?></h2>
          <h4> <?php echo $lang['verif-mdp'] ?></h4>
          <div class="element">
            <input class="text-danger" type="password" name="verifyPassword" required>
            <span></span>
            <label> <?php echo $lang['verif-mdp'] ?></label>
          </div>
          <p> <?php echo $lang['profile-question'] ?></p>
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