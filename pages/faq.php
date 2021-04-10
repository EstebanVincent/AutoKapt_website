<?php
  $pathHeader = $_SERVER['DOCUMENT_ROOT'];
  $pathHeader .= '/AutoKapt/bases/header.php'; /* psq le / va voir la vrai root d'ou cette méthode */
  include_once($pathHeader);
?>

<div class="container-fluid bg-secondary">
	<div class="py-3"></div>
	<section class="dark2 pb-2 mx-5 rounded text-white-50">
		<h2>F.A.Q.</h2>
	</section>
	<div class="py-3"></div>
	<section class="dark2 py-2 mx-5 rounded">
		<div class="accordion py-0" id="accordionExample">
<?php
require_once '../includes/dataBaseHandler.inc.php';
require_once '../includes/functions.inc.php';

showFAQ($conn, $_SESSION['userLanguage'])

?>
		</div>
	</section>
	<div class="py-3"></div>
</div>
<?php
  $pathFooter = $_SERVER['DOCUMENT_ROOT'];
  $pathFooter .= '/AutoKapt/bases/footer.php';/* psq le / va voir la vrai root d'ou cette méthode */
  include_once($pathFooter);
?>