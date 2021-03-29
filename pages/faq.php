<?php
  $pathHeader = $_SERVER['DOCUMENT_ROOT'];
  $pathHeader .= '/AutoKapt/bases/header.php'; /* psq le / va voir la vrai root d'ou cette méthode */
  include_once($pathHeader);
?>
	<div id = "imagePrincipale">
		<h1>Infinite Mesures</h1>
		<div id = "firstLine"></div>
		<h3>Foire aux Questions</h3>
	</div>

	</header>  

	<section>
		<div class="container">
			<div class="QA">

			<?php
			require_once '../includes/dataBaseHandler.inc.php';
			require_once '../includes/functions.inc.php';
			/* showFAQ($conn) */
			hintSearch($conn)
			?>
			</div>
		</div>

	</section>
       
<?php
  $pathFooter = $_SERVER['DOCUMENT_ROOT'];
  $pathFooter .= '/AutoKapt/bases/footer.php';/* psq le / va voir la vrai root d'ou cette méthode */
  include_once($pathFooter);
?>