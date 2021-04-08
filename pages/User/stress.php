<?php
  $pathHeader = $_SERVER['DOCUMENT_ROOT'];
  $pathHeader .= '/AutoKapt/bases/header.php'; /* psq le / va voir la vrai root d'ou cette méthode */
  include_once($pathHeader);
?>
    <div id = "imagePrincipale">
		<h1>Infinite Mesures</h1>
		<div id = "firstLine"></div>
		<h3>Foire aux Questions</h3>
	</div>

	</header> 
<body>
    <div id="UserBPM" style="height: 370px; width: 100%;"></div>
	<div id="UserTemp" style="height: 370px; width: 100%;"></div>
    <?php
    require_once '../../includes/dataBaseHandler.inc.php';
    require_once '../../includes/functions.inc.php';

    $dataBPM = getBPMHistoryUser($conn, $_SESSION["userId"]);
	$dataTemp = getTempHistoryUser($conn, $_SESSION["userId"]);
    ?>
</body>
<script>
var dataBPM = <?php echo json_encode($dataBPM, JSON_NUMERIC_CHECK); ?>;
var dataTemp = <?php echo json_encode($dataTemp, JSON_NUMERIC_CHECK); ?>;
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