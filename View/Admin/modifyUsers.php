<?php
  require_once($_SERVER['DOCUMENT_ROOT'].'/AutoKapt/bases/header.php');
  if (!isset($_SESSION['userAccess'])){
    die(header("Location: /AutoKapt/home.php"));
}
if ($_SESSION['userAccess'] != 0 ){
    die(header("Location: /AutoKapt/home.php"));
}
?>

<div class="container-fluid bg-secondary text-white-50">
	<div class="py-3"></div>
	<section class="dark2 py-2 mx-5 card">
        <div class="card-body">
            <div class="card-title"><b><?php echo $lang['geruser'] ?></b> </div>
            <p class="card-text">
                <?php echo $lang['modif-user1'] ?> 
            </p>
            <div class="form"></div>
        </div>
	</section>
    <div class="py-3"></div>
    <section class="dark2 py-2 mx-5 card">
        <div class="card-body">
            <div class="card-title"><b><?php echo $lang['faq1'] ?></b> </div>
            <p class="card-text">  <?php echo $lang['modif-user2'] ?> </p>
            <div class="post_msg text-info"> </div>
        </div>
	</section>
    <div class="py-3"></div>
    <section class="dark2 py-2 mx-5 card">
        <div class="card-body">
            <div class="card-title"><b><?php echo $lang['modif-user3'] ?> </b> </div>
            <div class="table_users"></div>
	    </div>
	</section>
    <div class="py-3"></div>
</div>
<script src="/AutoKapt/js/admin/tableUsers.js"></script>


<?php
require_once(__ROOT__.'bases/footer.php');
?>