<?php
  require_once($_SERVER['DOCUMENT_ROOT'].'/AutoKapt/bases/header.php');
  require_once(__ROOT__.'includes/functions.inc.php');
  IP_2_db($conn);
?>
<div class="container-fluid bg-secondary text-white-50">
    <div class="py-3"></div>
	<section class="dark2 py-2 mx-5 card">
        <div class="card-body">
            <div class="card-title text-center"><h2 class="fw-bold text-info"><?php echo $lang['golden-title'] ?></h2> </div>
            <p class="card-text text-center text-info fs-4">Person <?php echo got_trolled($conn) ?> to get Rick Rolled by us</p>
        </div>
        <img src="/AutoKapt/images/rick_astley.jpg" class="card-img-top" alt="...">
	</section>
    <div class="py-3"></div>
</div>
<script>
/* window.open("https://www.youtube.com/watch?v=dQw4w9WgXcQ"); */
</script>

<?php
require_once(__ROOT__.'bases/footer.php');
?>