<?php
  require_once($_SERVER['DOCUMENT_ROOT'].'/AutoKapt/bases/header.php');
?>


<div class="container-fluid bg-secondary text-white-50">
	<div class="py-3"></div>
	<section class="dark2 py-2 mx-5 card">
        <div class="card-body">
            <div class="card-title"><b>Gérer les utilisateurs</b> </div>
            <p class="card-text">
                Dans cette page vous pouvez effectuer une recherche avancée sur les utilisateurs.<br>
                Mais aussi modifier ou supprimer des utilisateurs. 
            </p>
            <div class="form"></div>
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
<script src="/AutoKapt/js/admin/tableUsers.js"></script>


<?php
require_once(__ROOT__.'bases/footer.php');
?>