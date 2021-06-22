<?php
  require_once($_SERVER['DOCUMENT_ROOT'].'/AutoKapt/bases/header.php');
  require_once(__ROOT__.'Model/integration.inc.php');
  if (!isset($_SESSION['userAccess'])){
    die(header("Location: /AutoKapt/home.php"));
}
?>

<!-- on accede à la base de donnée pour récupérer les info
On calcul les % en réunissant par tranche de résultats
on les transforme en tableau lisible par canvasJS une fois mis en json -->
<?php
    require_once __ROOT__.'Model/functions.inc.php';

	$dataBPMTotal = BPMTotal2Chart(getBPMTotal($conn, $_SESSION["userId"])[0]);
	$dataTempTotal = TempTotal2Chart(getTempTotal($conn, $_SESSION["userId"])[0]);
?>

<div class="container-fluid bg-secondary text-white-50">
	<div class="py-3"></div>
    <a class="unstyle" href="/AutoKapt/View/integration.php"><!-- mettre le lien qui start le code énergia -->
        <section class="dark2 py-2 mx-5 rounded text-center bg-info text-dark">
            <i class="fas fa-brain fs-1 pt-5"></i>
            <h2><?php echo $lang['p.stress-title'] ?></h2>
            <?php echo $lang['p.stress-description'] ?>
        </section>
    </a>
    <div class="py-3"></div>
    <div class="row">
        <div class="col text-center">
            <section class="dark2 py-2 ms-5 me-2 rounded">
                <h4><?php echo $lang['p.stress-stats'] ?></h4>
                <div id="BPMStats" style="height: 370px; width: 100%;"></div>
                <div class="py-3"></div>
                <div id="TempStats" style="height: 370px; width: 100%;"></div>
            </section>
        </div>
        <div class="col text-center">
            <section class="dark2 py-2 ms-2 me-5 rounded">
                <h4><?php echo $lang['p.stress-about'] ?></h4>
                <?php echo $lang['p.stress-p'] ?>
            </section>
        </div>
    </div>
    <div class="py-3"></div>
</div>

<script>

var dataBPMTotal = <?php echo json_encode($dataBPMTotal, JSON_NUMERIC_CHECK); ?>;
var dataTempTotal = <?php echo json_encode($dataTempTotal, JSON_NUMERIC_CHECK); ?>;

</script>
<script src="/AutoKapt/js/play/p.stress.js"></script>

<?php
require_once(__ROOT__.'includes/errors.inc.php');
require_once(__ROOT__.'bases/footer.php');
?>