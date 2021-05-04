<?php
  require_once($_SERVER['DOCUMENT_ROOT'].'/AutoKapt/bases/header.php');
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

<section>
	<h2>Mesure des reflexes sonores</h2>
	<div class="graphs">
		<div id="UserSound" style="height: 370px; width: 100%;"></div>
		<div id="SoundStats" style="height: 370px; width: 100%;"></div>
	</div>
</section>
	
	
    <?php
    require_once __ROOT__.'includes/functions.inc.php';

	$dataVisual = getVisualHistoryUser($conn, $_SESSION["userId"]);

	$dataVisualTotal = VisualTotal2Chart(getVisualTotal($conn, $_SESSION["userId"])[0]);
	$dataVisualPerso = VisualTotal2Chart(getVisualTotal($conn, $_SESSION["userId"])[1]);

	$dataSound = getSoundHistoryUser($conn, $_SESSION["userId"]);

	$dataSoundTotal = SoundTotal2Chart(getSoundTotal($conn, $_SESSION["userId"])[0]);
	$dataSoundPerso = SoundTotal2Chart(getSoundTotal($conn, $_SESSION["userId"])[1]);



    ?>
</body>
<script>
var dataVisual = <?php echo json_encode($dataVisual, JSON_NUMERIC_CHECK); ?>;
var dataVisualTotal = <?php echo json_encode($dataVisualTotal, JSON_NUMERIC_CHECK); ?>;
var dataVisualPerso = <?php echo json_encode($dataVisualPerso, JSON_NUMERIC_CHECK); ?>;

var dataSound = <?php echo json_encode($dataSound, JSON_NUMERIC_CHECK); ?>;
var dataSoundTotal = <?php echo json_encode($dataSoundTotal, JSON_NUMERIC_CHECK); ?>;
var dataSoundPerso = <?php echo json_encode($dataSoundPerso, JSON_NUMERIC_CHECK); ?>;

</script>
<script src="/AutoKapt/js/reflex.js"></script>

<?php
require_once(__ROOT__.'includes/errors.inc.php');
require_once(__ROOT__.'bases/footer.php');
?>