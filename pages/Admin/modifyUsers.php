<?php
  $pathHeader = $_SERVER['DOCUMENT_ROOT'];
  $pathHeader .= '/AutoKapt/bases/header.php'; /* psq le / va voir la vrai root d'ou cette méthode */
  include_once($pathHeader);

  require_once '../../includes/dataBaseHandler.inc.php';
  require_once '../../includes/functions.inc.php';
?>


<div class="container-fluid bg-secondary text-white-50">
	<div class="py-3"></div>
	<section class="dark2 py-2 mx-5 card">
        <div class="card-body">
            <div class="card-title"><b>Gérer les utilisateurs</b> </div>
            <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequatur ipsa quam excepturi autem animi, eveniet maxime dolor, iste odio, est laudantium consectetur possimus magni veritatis tenetur incidunt illum aperiam quos!</p>
        </div>
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
            <div class="card-title"><b>All users</b> </div>
            <div class="table_users"></div>
	    </div>
	</section>
    <div class="py-3"></div>
</div>
<script src="/AutoKapt/js/tableUsers.js"></script>


<?php
  $pathFooter = $_SERVER['DOCUMENT_ROOT'];
  $pathFooter .= '/AutoKapt/bases/footer.php';/* psq le / va voir la vrai root d'ou cette méthode */
  include_once($pathFooter);
?>