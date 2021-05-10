<?php
  require_once($_SERVER['DOCUMENT_ROOT'].'/AutoKapt/bases/header.php');
?>

<?php
    require_once __ROOT__.'includes/functions.inc.php';

	$dataVisual = getVisualHistoryUser($conn, $_SESSION["userId"]);

	$dataVisualTotal = VisualTotal2Chart(getVisualTotal($conn, $_SESSION["userId"])[0]);
	$dataVisualPerso = VisualTotal2Chart(getVisualTotal($conn, $_SESSION["userId"])[1]);

	$dataSound = getSoundHistoryUser($conn, $_SESSION["userId"]);

	$dataSoundTotal = SoundTotal2Chart(getSoundTotal($conn, $_SESSION["userId"])[0]);
	$dataSoundPerso = SoundTotal2Chart(getSoundTotal($conn, $_SESSION["userId"])[1]);

	$moyVisual = moyenne($conn, $dataVisual);
	$moySound = moyenne($conn, $dataSound);

    ?>

<div class="container-fluid bg-secondary text-white-50">
	<div class="py-3"></div>
	<section class="dark2 py-2 mx-5 rounded">
		<div class="row">
			<div class="col text-center">
				<h2>Visual</h2>
			</div>
		</div>
		<div class="row">
			<div class="col">
				<h2>Visual</h2>
				<h5 class="text-center text-danger"><?php echo $moyVisual?> ms</h5>
			</div>
			<div class="col">
				<h2>Sound</h2>
				<h5 class="text-center text-danger"><?php echo $moySound?> ms</h5>
			</div>
		</div>
		<div class="row">
			<div class="col text-center">
				<a href="/AutoKapt/pages/User/play/p.memory.php"><button class="btn btn-secondary"><i class="far fa-play-circle"></i> Play</button></a>
			</div>
		</div>
	</section>
	<div class="py-3"></div>
	<section class="dark2 py-2 mx-5 rounded">
		<h2>Reflexes visuels</h2>
		<div class="graphs">
			<div id="UserVisual" style="height: 370px; width: 100%;"></div>
			<div id="VisualStats" style="height: 370px; width: 100%;"></div>
		</div>
	</section>
	<div class="py-3"></div>
	<section class="dark2 py-2 mx-5 rounded">
		<h2>Reflexes sonores</h2>
		<div class="graphs">
			<div id="UserSound" style="height: 370px; width: 100%;"></div>
			<div id="SoundStats" style="height: 370px; width: 100%;"></div>
		</div>
	</section>
	<div class="py-3"></div>
</div>
<script>
var dataVisual = <?php echo json_encode($dataVisual, JSON_NUMERIC_CHECK); ?>;
var dataVisualTotal = <?php echo json_encode($dataVisualTotal, JSON_NUMERIC_CHECK); ?>;
var dataVisualPerso = <?php echo json_encode($dataVisualPerso, JSON_NUMERIC_CHECK); ?>;

var dataSound = <?php echo json_encode($dataSound, JSON_NUMERIC_CHECK); ?>;
var dataSoundTotal = <?php echo json_encode($dataSoundTotal, JSON_NUMERIC_CHECK); ?>;
var dataSoundPerso = <?php echo json_encode($dataSoundPerso, JSON_NUMERIC_CHECK); ?>;

</script>
<script src="/AutoKapt/js/result/memory.js"></script>

<?php
require_once(__ROOT__.'includes/errors.inc.php');
require_once(__ROOT__.'bases/footer.php');
?>