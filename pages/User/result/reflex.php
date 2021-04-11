<?php
  $pathHeader = $_SERVER['DOCUMENT_ROOT'];
  $pathHeader .= '/AutoKapt/bases/header.php'; /* psq le / va voir la vrai root d'ou cette méthode */
  include_once($pathHeader);
?>
    <div id = "imagePrincipale">
		<h1>Infinite Mesures</h1>
		<div id = "firstLine"></div>
		<h3>Mesure des Reflexes</h3>
	</div>

	</header> 
<body>
<section>
	<h2>Mesure des reflexes visuels</h2>
	<div class="graphs">
		<div id="UserVisual" style="height: 370px; width: 100%;"></div>
		<div id="VisualStats" style="height: 370px; width: 100%;"></div>
	</div>
</section>

<!-- <section>
	<h2>Mesure de la Temepérature</h2>
	<div class="graphs">
		<div id="UserTemp" style="height: 370px; width: 100%;"></div>
		<div id="TempStats" style="height: 370px; width: 100%;"></div>
	</div>
</section> -->
	
	
    <?php
    require_once '../../../includes/dataBaseHandler.inc.php';
    require_once '../../../includes/functions.inc.php';

	$dataVisual = getVisualHistoryUser($conn, $_SESSION["userId"]);

	$dataVisualTotal = VisualTotal2Chart(getVisualTotal($conn, $_SESSION["userId"])[0]);
	$dataVisualPerso = VisualTotal2Chart(getVisualTotal($conn, $_SESSION["userId"])[1]);


	/* $dataTemp = getTempHistoryUser($conn, $_SESSION["userId"]);

	$dataTempTotal = TempTotal2Chart(getTempTotal($conn, $_SESSION["userId"])[0]);
	$dataTempPerso = TempTotal2Chart(getTempTotal($conn, $_SESSION["userId"])[1]); */


    ?>
</body>
<script>
var dataVisual = <?php echo json_encode($dataVisual, JSON_NUMERIC_CHECK); ?>;
var dataVisualTotal = <?php echo json_encode($dataVisualTotal, JSON_NUMERIC_CHECK); ?>;
var dataVisualPerso = <?php echo json_encode($dataVisualPerso, JSON_NUMERIC_CHECK); ?>;



</script>
<script src="../../../js/reflex.js"></script>

<?php
$pathErrors = $_SERVER['DOCUMENT_ROOT'];
$pathErrors .= '/AutoKapt/includes/errors.inc.php'; /* psq le / va voir la vrai root d'ou cette méthode */
include_once($pathErrors);

$pathFooter = $_SERVER['DOCUMENT_ROOT'];
$pathFooter .= '/AutoKapt/bases/footer.php';/* psq le / va voir la vrai root d'ou cette méthode */
include_once($pathFooter);
?>