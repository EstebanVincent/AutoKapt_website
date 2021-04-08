<?php
  $pathHeader = $_SERVER['DOCUMENT_ROOT'];
  $pathHeader .= '/AutoKapt/bases/header.php'; /* psq le / va voir la vrai root d'ou cette méthode */
  include_once($pathHeader);
?>
    <div id = "imagePrincipale">
		<h1>Infinite Mesures</h1>
		<div id = "firstLine"></div>
		<h3>Mesure du Stress</h3>
	</div>

	</header> 
<body>
<section>
	<h2>Mesure des BPM</h2>
	<div class="graphs">
		<div id="UserBPM" style="height: 370px; width: 100%;"></div>
		<div id="BPMStats" style="height: 370px; width: 100%;"></div>
	</div>
</section>

<section>
	<h2>Mesure de la Temepérature</h2>
	<div class="graphs">
		<div id="UserTemp" style="height: 370px; width: 100%;"></div>
		<div id="TempStats" style="height: 370px; width: 100%;"></div>
	</div>
</section>
	
	
    <?php
    require_once '../../includes/dataBaseHandler.inc.php';
    require_once '../../includes/functions.inc.php';

	$dataBPM = getBPMHistoryUser($conn, $_SESSION["userId"]);

	$dataBPMTotal = BPMTotal2Chart(getBPMTotal($conn, $_SESSION["userId"])[0]);
	$dataBPMPerso = BPMTotal2Chart(getBPMTotal($conn, $_SESSION["userId"])[1]);


	$dataTemp = getTempHistoryUser($conn, $_SESSION["userId"]);

	$dataTempTotal = TempTotal2Chart(getTempTotal($conn, $_SESSION["userId"])[0]);
	$dataTempPerso = TempTotal2Chart(getTempTotal($conn, $_SESSION["userId"])[1]);


    ?>
</body>
<script>
var dataBPM = <?php echo json_encode($dataBPM, JSON_NUMERIC_CHECK); ?>;
var dataBPMTotal = <?php echo json_encode($dataBPMTotal, JSON_NUMERIC_CHECK); ?>;
var dataBPMPerso = <?php echo json_encode($dataBPMPerso, JSON_NUMERIC_CHECK); ?>;

var dataTemp = <?php echo json_encode($dataTemp, JSON_NUMERIC_CHECK); ?>;
var dataTempTotal = <?php echo json_encode($dataTempTotal, JSON_NUMERIC_CHECK); ?>;
var dataTempPerso = <?php echo json_encode($dataTempPerso, JSON_NUMERIC_CHECK); ?>;

</script>
<script src="../../js/stress.js"></script>

<?php
$pathErrors = $_SERVER['DOCUMENT_ROOT'];
$pathErrors .= '/AutoKapt/includes/errors.inc.php'; /* psq le / va voir la vrai root d'ou cette méthode */
include_once($pathErrors);

$pathFooter = $_SERVER['DOCUMENT_ROOT'];
$pathFooter .= '/AutoKapt/bases/footer.php';/* psq le / va voir la vrai root d'ou cette méthode */
include_once($pathFooter);
?>