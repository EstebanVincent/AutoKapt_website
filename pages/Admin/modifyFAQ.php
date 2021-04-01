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
			require_once '../../includes/dataBaseHandler.inc.php';
            require_once '../../includes/functions.inc.php';
			showFAQAdmin($conn, $_SESSION["userLanguage"]);
			?>
			</div>
            <p id="demo"></p>
            <button type="button" class="open-button" onclick="openAdd()"><i class="fas fa-plus">Add question</i></button>

			<div class="addQuestion-popup" id="add">
				<button type="button" class="btn cancel" onclick="closeAdd()"><i class="far fa-window-close"></i></button>
				<form action="../../includes/Admin/modifyFAQ.inc.php" class="form-container" id="addQuestion" method="post">
					<input type="hidden" name="language" value= <?php echo $_SESSION["userLanguage"] ?>/>
					<h4>Question</h4>
					<textarea form ="addQuestion" name="question" rows="2" maxlength="140" minlength="20" required></textarea>
					<h4>Answer</h4>
					<textarea form ="addQuestion" name="answer" rows="6" maxlength="280" minlength="20" required></textarea>
					<button type="submit" name="addQuestion-submit">Confirm</button>
				</form>
			</div>
		</div>
	</section>

	<script src="../../js/modifyFAQ.js"></script>

  <?php
  $pathErrors = $_SERVER['DOCUMENT_ROOT'];
  $pathErrors .= '/AutoKapt/includes/errors.inc.php'; /* psq le / va voir la vrai root d'ou cette méthode */
  include_once($pathErrors);

  $pathFooter = $_SERVER['DOCUMENT_ROOT'];
  $pathFooter .= '/AutoKapt/bases/footer.php';/* psq le / va voir la vrai root d'ou cette méthode */
  include_once($pathFooter);
?>