<?php
  require_once($_SERVER['DOCUMENT_ROOT'].'/AutoKapt/bases/header.php');
?>

<!-- on accede à la base de donnée pour récupérer les info
On calcul les % en réunissant par tranche de résultats
on les transforme en tableau lisible par canvasJS une fois mis en json -->
<?php
    require_once __ROOT__.'includes/functions.inc.php';

	$dataBPMTotal = BPMTotal2Chart(getBPMTotal($conn, $_SESSION["userId"])[0]);
	$dataTempTotal = TempTotal2Chart(getTempTotal($conn, $_SESSION["userId"])[0]);
?>

<div class="container-fluid bg-secondary text-white-50">
	<div class="py-3"></div>
    <a class="unstyle" href="#"><!-- mettre le lien qui start le code énergia -->
        <section class="dark2 py-2 mx-5 rounded text-center bg-info text-dark">
            <i class="fas fa-brain fs-1 pt-5"></i>
            <h2>Memory Test</h2>
            <p class="my-0">You will hear a sound with a certain rythm.</p>
            <p class="my-0">Try to repeat the same rythm afterwards</p>
            <p class="my-0 pb-5">Click anywhere to start.</p>
        </section>
    </a>
    <div class="py-3"></div>
    <div class="row">
        <div class="col text-center">
            <section class="dark2 py-2 ms-5 me-2 rounded">
                <h4>Statistics</h4>
                <div id="BPMStats" style="height: 370px; width: 100%;"></div>
                <div class="py-3"></div>
                <div id="TempStats" style="height: 370px; width: 100%;"></div>
            </section>
        </div>
        <div class="col text-center">
            <section class="dark2 py-2 ms-2 me-5 rounded">
                <h4>About the test</h4>
                <p class="justify px-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci sed nostrum animi enim iusto aliquid voluptate incidunt molestias distinctio itaque aspernatur laborum, veniam nobis et recusandae quae asperiores culpa cum, eligendi, earum ut alias in eius quasi! Incidunt adipisci natus, quos autem iure tempora veniam fugit necessitatibus, minima id suscipit.</p>
                <p class="justify px-5">Lorem ipsum dolor sit amet consectetur adipisicing elit. Velit natus reiciendis nam dolores itaque blanditiis.</p>
                <p class="justify px-5">Lorem ipsum dolor sit amet consectetur adipisicing elit. Velit natus reiciendis nam dolores itaque blanditiis.</p>
            </section>
        </div>
    </div>
    <div class="py-3"></div>
</div>

<script>

var dataBPMTotal = <?php echo json_encode($dataBPMTotal, JSON_NUMERIC_CHECK); ?>;
var dataTempTotal = <?php echo json_encode($dataTempTotal, JSON_NUMERIC_CHECK); ?>;

</script>
<script src="/AutoKapt/js/play/p.memory.js"></script>

<?php
require_once(__ROOT__.'includes/errors.inc.php');
require_once(__ROOT__.'bases/footer.php');
?>