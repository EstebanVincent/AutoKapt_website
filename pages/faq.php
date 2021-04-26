<?php
  require_once($_SERVER['DOCUMENT_ROOT'].'/AutoKapt/bases/header.php');
?>

<div class="container-fluid bg-secondary">
	<div class="py-3"></div>
	<section class="dark2 pb-2 mx-5 rounded text-white-50">
		<h2>F.A.Q.</h2>
	</section>
	<div class="py-3"></div>
	<section class="dark2 py-2 mx-5 rounded">
		<div class="accordion py-0" id="accordionFAQ">
<?php
require_once __ROOT__.'includes/functions.inc.php';

showFAQ($conn, $_SESSION['userLanguage'])

?>
		</div>
	</section>
	<div class="py-3"></div>
</div>
<?php
  require_once(__ROOT__.'bases/footer.php');
?>