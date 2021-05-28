<?php
  require_once($_SERVER['DOCUMENT_ROOT'].'/AutoKapt/bases/header.php');
?>
<!-- on accede à la base de donnée pour récupérer les info
On calcul les % en réunissant par tranche de résultats
on les transforme en tableau lisible par canvasJS une fois mis en json -->
<?php
    require_once __ROOT__.'Model/functions.inc.php';

	$dataBPM = getBPMHistoryUser($conn, $_SESSION["userId"]);

	$dataBPMTotal = BPMTotal2Chart(getBPMTotal($conn, $_SESSION["userId"])[0]);
	$dataBPMPerso = BPMTotal2Chart(getBPMTotal($conn, $_SESSION["userId"])[1]);

	$dataTemp = getTempHistoryUser($conn, $_SESSION["userId"]);

	$dataTempTotal = TempTotal2Chart(getTempTotal($conn, $_SESSION["userId"])[0]);
	$dataTempPerso = TempTotal2Chart(getTempTotal($conn, $_SESSION["userId"])[1]);

	$tempBPM = moyenne($conn, $dataBPM);
	if ($tempBPM == 'no data'){
		$moyBPM = 'NA';
	} else {
		$moyBPM = (string)$tempBPM;
	}
	$TempTemp = moyenne($conn, $dataTemp);
	if ($TempTemp == 'no data'){
		$moyTemp = 'NA';
	} else {
		$moyTemp = (string)$TempTemp.' °C';
	}
?>

<div class="container-fluid bg-secondary text-white-50">
	<div class="py-3"></div>
	<section class="dark2 py-2 mx-5 rounded">
		<div class="row">
			<div class="col text-center">
				<h2>Stress</h2>
			</div>
		</div>
		<div class="row">
			<div class="col">
				<h2>BPM</h2>
				<h5 class="text-center text-danger"><?php echo $moyBPM?></h5>
			</div>
			<div class="col">
				<h2>Temperature</h2>
				<h5 class="text-center text-danger"><?php echo $moyTemp?></h5>
			</div>
		</div>
		<div class="row">
			<div class="col text-center">
				<a href="/AutoKapt/View/User/play/p.stress.php"><button class="btn btn-secondary"><i class="far fa-play-circle"></i><?php echo $lang['stress-play'] ?></button></a>
			</div>
		</div>
	</section>
	<div class="py-3"></div>
	<section class="dark2 py-2 mx-5 rounded">
		<h2><?php echo $lang['stress-bpm'] ?></h2>
		<div class="graphs">
			<div id="UserBPM" style="height: 370px; width: 100%;"></div>
			<div id="BPMStats" style="height: 370px; width: 100%;"></div>
		</div>
	</section>
	<div class="py-3"></div>
	<section class="dark2 py-2 mx-5 rounded">
		<h2><?php echo $lang['stress-temp'] ?></h2>
		<div class="graphs">
			<div id="UserTemp" style="height: 370px; width: 100%;"></div>
			<div id="TempStats" style="height: 370px; width: 100%;"></div>
		</div>
	</section>
	<div class="py-3"></div>
</div>
	
<script>
var dataBPM = <?php echo json_encode($dataBPM, JSON_NUMERIC_CHECK); ?>;
var dataBPMTotal = <?php echo json_encode($dataBPMTotal, JSON_NUMERIC_CHECK); ?>;
var dataBPMPerso = <?php echo json_encode($dataBPMPerso, JSON_NUMERIC_CHECK); ?>;

var dataTemp = <?php echo json_encode($dataTemp, JSON_NUMERIC_CHECK); ?>;
var dataTempTotal = <?php echo json_encode($dataTempTotal, JSON_NUMERIC_CHECK); ?>;
var dataTempPerso = <?php echo json_encode($dataTempPerso, JSON_NUMERIC_CHECK); ?>;

</script>
<script src="/AutoKapt/js/result/stress.js"></script>

<?php
require_once(__ROOT__.'includes/errors.inc.php');
require_once(__ROOT__.'bases/footer.php');
?>