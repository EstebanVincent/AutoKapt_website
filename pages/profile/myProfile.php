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
<!-- 
Tes infos, changer mdp
Graph evo dernier test
Moyenne des tests
-->
<?php
  $pathFooter = $_SERVER['DOCUMENT_ROOT'];
  $pathFooter .= '/AutoKapt/bases/footer.php';/* psq le / va voir la vrai root d'ou cette méthode */
  include_once($pathFooter);
?>