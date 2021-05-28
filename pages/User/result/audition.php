<?php
  require_once($_SERVER['DOCUMENT_ROOT'].'/AutoKapt/bases/header.php');
?>

<?php
    require_once __ROOT__.'includes/functions.inc.php';

	$dataAudition = getauditionscore($conn, $_SESSION["userId"]);

	$dataAuditionTotal = auditionTotal2Chart(getauditionTotal($conn, $_SESSION["userId"])[0]);
	$dataAuditionPerso = AuditionTotal2Chart(getauditionTotal($conn, $_SESSION["userId"])[1]);

	
	
	$scoreAuditionmoy= moyenne($conn, $dataAudition);
	if ($scoreAuditionmoy == 'no data'){
		$moyVisual = 'NA';
	} else {
		$moyVisual = 'Votre score est de '.(string)$scoreAuditionmoy;
	}
?>

<div class="container-fluid bg-secondary text-white-50">
	<div class="py-3"></div>
	<section class="dark2 py-2 mx-5 rounded">
		<div class="row">
			<div class="col text-center">
				<h2>Audition </h2>
			</div>
		</div>
		<div class="row">
			<div class="col">
				<h2>Audition</h2>
				<h5 class="text-center text-danger"><?php echo $moyVisual?></h5>
			</div>
		</div>
		<div class="row">
			<div class="col text-center">
				<a href="/AutoKapt/pages/User/play/p.reflex.php"><button class="btn btn-secondary"><i class="far fa-play-circle"></i> Play</button></a>
			</div>
		</div>
	</section>
	<div class="py-3"></div>
	<section class="dark2 py-2 mx-5 rounded">
		<h2>Audition results</h2>
		<div class="graphs">
			<div id="UserAudition" style="height: 370px; width: 100%;"></div>
			<div id="AuditionStats" style="height: 370px; width: 100%;"></div>
		</div>
	</section>
</div>
<script>
var dataAudition = <?php echo json_encode($dataAudition, JSON_NUMERIC_CHECK); ?>;
var dataAuditionTotal = <?php echo json_encode($dataAuditionTotal, JSON_NUMERIC_CHECK); ?>;
var dataAuditionPerso = <?php echo json_encode($dataAuditionPerso, JSON_NUMERIC_CHECK); ?>;



</script>
<script src="/AutoKapt/js/result/audition.js"></script>

<?php
require_once(__ROOT__.'includes/errors.inc.php');
require_once(__ROOT__.'bases/footer.php');
?>