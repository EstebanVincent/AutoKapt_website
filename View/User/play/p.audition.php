<?php
  require_once($_SERVER['DOCUMENT_ROOT'].'/AutoKapt/bases/header.php');
?>

<!-- on accede à la base de donnée pour récupérer les info
On calcul les % en réunissant par tranche de résultats
on les transforme en tableau lisible par canvasJS une fois mis en json -->
<?php
    require_once __ROOT__.'Model/functions.inc.php';

	$dataAuditionTotal = AuditionTotal2Chart(getAuditionTotal($conn, $_SESSION["userId"])[0]);
	
?>

<div class="container-fluid bg-secondary text-white-50">
	<div class="py-3"></div>
    <a class="unstyle" href="#"><!-- mettre le lien qui start le code énergia -->
        <section class="dark2 py-2 mx-5 rounded text-center bg-info text-dark">
            <i class="fas fa-brain fs-1 pt-5"></i>
            <h2><?php echo $lang['pageson1'] ?></h2>
            <p class="my-0"><?php echo $lang['pageson1'] ?></p>
            <p class="my-0"><?php echo $lang['pageson2'] ?></p>
            <p class="my-0 pb-5"><?php echo $lang['pageson3'] ?></p>
        </section>
    </a>
    <div class="py-3"></div>
    <div class="row">
        <div class="col text-center">
            <section class="dark2 py-2 ms-5 me-2 rounded">
                <h4><?php echo $lang['pageson4'] ?></h4>
                <div id="AuditionStats" style="height: 370px; width: 100%;"></div>
                
            </section>
        </div>
        <div class="col text-center">
            <section class="dark2 py-2 ms-2 me-5 rounded">
                <h4><?php echo $lang['pageson5'] ?></h4>
                <p class="justify px-5"><?php echo $lang['pageson6'] ?></p>
                <p class="justify px-5"><?php echo $lang['pageson7'] ?></p>
                <p class="justify px-5"></p>
            </section>
        </div>
    </div>
    <div class="py-3"></div>
</div>

<script>

var dataAuditionTotal = <?php echo json_encode($dataAuditionTotal, JSON_NUMERIC_CHECK); ?>;



</script>
<script src="/AutoKapt/js/play/p.audition.js"></script>

<?php
require_once(__ROOT__.'includes/errors.inc.php');
require_once(__ROOT__.'bases/footer.php');
?>