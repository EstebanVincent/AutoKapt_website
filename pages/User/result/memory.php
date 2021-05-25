<?php
  require_once($_SERVER['DOCUMENT_ROOT'].'/AutoKapt/bases/header.php');
?>
<!-- on accede à la base de donnée pour récupérer les info
On calcul les % en réunissant par tranche de résultats
on les transforme en tableau lisible par canvasJS une fois mis en json -->
<?php
    require_once __ROOT__.'includes/functions.inc.php';

	$dataMemory = getMemoryHistoryUser($conn, $_SESSION["userId"]);

	$dataMemoryTotal = MemoryTotal2Chart(getMemoryTotal($conn, $_SESSION["userId"])[0]);
	$dataMemoryPerso = MemoryTotal2Chart(getMemoryTotal($conn, $_SESSION["userId"])[1]);

	$tempMemory = moyenne($conn, $dataMemory);
	if ($tempMemory == 'no data'){
		$moyMemory = 'NA';
	} else {
		$moyMemory = (string)$tempMemory;
	}
?>

<div class="container-fluid bg-secondary text-white-50">
	<div class="py-3"></div>
	<section class="dark2 py-2 mx-5 rounded">
		<div class="row">
			<div class="col text-center">
				<h2>Memory</h2>
			</div>
		</div>
		<div class="row">
			<div class="col">
				<h2>Memory</h2>
				<h5 class="text-center text-danger"><?php echo $moyMemory?></h5>
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
		<h2>Mesure des Memory</h2>
		<div class="graphs">
			<div id="UserMemory" style="height: 370px; width: 100%;"></div>
			<div id="MemoryStats" style="height: 370px; width: 100%;"></div>
		</div>
	</section>
	<div class="py-3"></div>
</div>
	
<script>
var dataMemory = <?php echo json_encode($dataMemory, JSON_NUMERIC_CHECK); ?>;
var dataMemoryTotal = <?php echo json_encode($dataMemoryTotal, JSON_NUMERIC_CHECK); ?>;
var dataMemoryPerso = <?php echo json_encode($dataMemoryPerso, JSON_NUMERIC_CHECK); ?>;


</script>
<script src="/AutoKapt/js/result/memory.js"></script>

<?php
require_once(__ROOT__.'includes/errors.inc.php');
require_once(__ROOT__.'bases/footer.php');
?>