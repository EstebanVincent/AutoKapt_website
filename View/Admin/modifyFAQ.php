<?php
  require_once($_SERVER['DOCUMENT_ROOT'].'/AutoKapt/bases/header.php');

  require_once __ROOT__.'Model/functions.inc.php';
?>
<div class="container-fluid bg-secondary text-white-50">
	<div class="py-3"></div>
	<section class="dark2 pb-2 mx-5 rounded">
		<h2>F.A.Q.</h2>
	</section>
	<div class="py-3"></div>
	<section class="dark2 py-2 mx-5 card">
        <div class="card-body">
            <div class="card-title"><b>HTML Table Edits/Upates</b> </div>
            <p class="card-text">All the changes will be displayed below</p>
            <div class="post_msg text-info"> </div>
        </div>
	</section>
  <div class="py-3"></div>
	<section class="dark2 py-2 mx-5 card">
        <div class="card-body">
            <div class="card-title"><b>All Questions</b> </div>
            <div class="table_faq"></div>
	    </div>
	</section>
	<div class="py-3"></div>
</div>
<script src="/AutoKapt/js/admin/faqAdmin.js"></script>

  <?php
require_once(__ROOT__.'includes/errors.inc.php');
require_once(__ROOT__.'bases/footer.php');
?>