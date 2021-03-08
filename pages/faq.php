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
			$sql = "SELECT * FROM faq;";
			$results = mysqli_query($conn,$sql);
			$row_count = mysqli_num_rows($results);

			while ($rows = mysqli_fetch_assoc($results)) {
				echo '<div class="QA-item" id="question' .$rows['faqId'] . '">';
					echo '<a class="Question" href="#question' .$rows['faqId'] . '">' . $rows['faqQuestion'] . '</a>';
					echo '<div class="Answer"><p>' . $rows['faqAnswer'] . '</p></div>';
				echo '</div>';
    		}
			?>
			</div>
		</div>

	</section>
       
<?php
  $pathFooter = $_SERVER['DOCUMENT_ROOT'];
  $pathFooter .= '/AutoKapt/bases/footer.php';/* psq le / va voir la vrai root d'ou cette méthode */
  include_once($pathFooter);
?>