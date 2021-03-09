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
            /* require_once '../../includes/functions.inc.php'; */
			$sql = "SELECT * FROM faq;";
			$results = mysqli_query($conn,$sql);
			$row_count = mysqli_num_rows($results);

			while ($rows = mysqli_fetch_assoc($results)) {
				echo '<div class="QA-item" id="question' .$rows['faqId'] . '">';
					echo '<a class="Question" href="#question' .$rows['faqId'] . '">' . $rows['faqQuestion'];
                    echo '<i class="fas fa-edit"></i><button onclick="deleteQuestion(' . $rows['faqId'] . ')"><i class="fas fa-trash"></i></button></a>';
					echo '<div class="Answer"><p>' . $rows['faqAnswer'] . '</p></div>';
				echo '</div>';
    		}
			?>
			</div>
            <p id="demo"></p>
            <button type="button" class="open-button" onclick="openForm()"><i class="fas fa-plus">Add question</i></button>

			<div class="addQuestion-popup" id="myForm">
				<button type="button" class="btn cancel" onclick="closeForm()"><i class="far fa-window-close"></i></button>
				<form action="../../includes/Admin/FAQ.inc.php" class="form-container" id="addQuestion" method="post">
					<h4>Question</h4>
					<textarea form ="addQuestion" name="question" rows="2" maxlength="140" minlength="20" required></textarea>
					<h4>Answer</h4>
					<textarea form ="addQuestion" name="answer" rows="6" maxlength="280" minlength="20" required></textarea>
					<button type="submit" name="addQuestion-submit">Confirm</button>
				</form>
			</div>
		</div>
	</section>

    <script>
    function deleteQuestion(faqId) {
        if (confirm("Delete this question?")) {
            /* Utiliser la function php removeQuestionFAQ($conn, $faqId) */
        } 
    }  
	function openForm() {
	document.getElementById("myForm").style.display = "block";
	}

	function closeForm() {
	document.getElementById("myForm").style.display = "none";
	}
    </script>

  <?php
  $pathErrors = $_SERVER['DOCUMENT_ROOT'];
  $pathErrors .= '/AutoKapt/includes/errors.inc.php'; /* psq le / va voir la vrai root d'ou cette méthode */
  include_once($pathErrors);

  $pathFooter = $_SERVER['DOCUMENT_ROOT'];
  $pathFooter .= '/AutoKapt/bases/footer.php';/* psq le / va voir la vrai root d'ou cette méthode */
  include_once($pathFooter);
?>