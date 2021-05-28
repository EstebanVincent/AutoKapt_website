<?php
    require_once($_SERVER['DOCUMENT_ROOT'].'/AutoKapt/bases/header.php');
    require_once __ROOT__.'Model/functions.inc.php';
    /* stress data */
    $dataBPM = getBPMHistoryUser($conn, $_SESSION["userId"]);
    $dataTemp = getTempHistoryUser($conn, $_SESSION["userId"]);

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

    /* Reflex data */
    $dataVisual = getVisualHistoryUser($conn, $_SESSION["userId"]);
    $dataSound = getSoundHistoryUser($conn, $_SESSION["userId"]);

    $tempVisual = moyenne($conn, $dataVisual);
	if ($tempVisual == 'no data'){
		$moyVisual = 'NA';
	} else {
		$moyVisual = (string)$tempVisual.' ms';
	}
	$tempSound = moyenne($conn, $dataSound);
	if ($tempSound == 'no data'){
		$moySound = 'NA';
	} else {
		$moySound = (string)$tempSound.' ms';
	}

    /* memory data */
    $dataMemory = getMemoryHistoryUser($conn, $_SESSION["userId"]);

    $tempMemory = moyenne($conn, $dataMemory);
	if ($tempMemory == 'no data'){
		$moyMemory = 'NA';
	} else {
		$moyMemory = (string)$tempMemory;
	}

     //audition data 
     $dataAudition = getAuditionHistoryUser($conn, $_SESSION["userId"]);

    $scoreAuditionmoy = moyenneaud($conn, $dataAudition);
	if ($scoreAuditionmoy == 'no data'){
		$moyAudition = 'NA';
	} else {
		$moyAudition = (string)$scoreAuditionmoy;
	} 
?>
<div class="container-fluid bg-secondary text-white-50">
	<div class="py-3"></div>
	<section class="dark2 py-2 mx-5 card">
        <div class="card-body">
            <div class="card-title text-center"><h2 class="fw-bold text-info"><?php echo $lang['dashboard-title'] ?></h2> </div>
            <p class="card-text text-center text-info fs-4"><?php echo $lang['dashboard-p'] ?></p>
        </div>
	</section>
    <div class="py-3"></div>
    <section class="dark2 py-2 mx-5 card">
        <div class="card-body">
            <table class="table table-dark table-hover rounded overflow-hidden">
                <thead>
                    <tr class="text-white-50">
                    <th style="width: 33.33%" scope="col">Test</th>
                    <th style="width: 33.33%" scope="col">Actions</th>
                    <th style="width: 33.33%" scope="col">Score</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="text-white-50">
                        <td><h5>Stress</h5></td>
                        <td><a href="/AutoKapt/View/User/play/p.stress.php"><button class="btn btn-danger"><i class="far fa-play-circle"></i> <?php echo $lang['play'] ?></button></a><a href="/AutoKapt/View/User/result/stress.php"><button class="btn btn-danger"><i class="fas fa-chart-line"></i> Stats</button></a></td>
                        <td><?php echo $moyBPM . ' BPM | '. $moyTemp ?></td>
                    </tr>
                    <tr class="text-white-50">
                        <td><h5><?php echo $lang['dashboard-reflex'] ?></h5></td>
                        <td><a href="/AutoKapt/View/User/play/p.reflex.php"><button class="btn btn-danger"><i class="far fa-play-circle"></i> <?php echo $lang['play'] ?></button></a><a href="/AutoKapt/View/User/result/reflex.php"><button class="btn btn-danger"><i class="fas fa-chart-line"></i> Stats</button></a></td>
                        <td><?php echo $moyVisual . ' | '. $moySound ?></td>
                    </tr>
                    <tr class="text-white-50">
                        <td><h5><?php echo $lang['dashboard-memory'] ?></h5></td>
                        <td><a href="/AutoKapt/View/User/play/p.memory.php"><button class="btn btn-danger"><i class="far fa-play-circle"></i> <?php echo $lang['play'] ?></button></a><a href="/AutoKapt/View/User/result/memory.php"><button class="btn btn-danger"><i class="fas fa-chart-line"></i> Stats</button></a></td>
                        <td><?php echo $moyMemory.'/100' ?></td>
                    </tr>
                    <tr class="text-white-50">
                        <td><h5><?php echo $lang['dashboard-hearing'] ?></h5></td>
                        <td><a href="/AutoKapt/View/User/play/p.audition.php"><button class="btn btn-danger"><i class="far fa-play-circle"></i> <?php echo $lang['play'] ?></button></a><a href="/AutoKapt/View/User/result/audition.php"><button class="btn btn-danger"><i class="fas fa-chart-line"></i> Stats</button></a></td>
                        <td><?php  echo $moyAudition.'/100'  ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>
    <div class="py-3"></div>
    <section class="dark2 py-2 mx-5 card">
        <div class="card-body">
            <table class="table table-dark text-white-50 table-hover rounded overflow-hidden">
                <thead>
                    <tr>
                    <th style="width: 50%" scope="col">Test</th>
                    <th style="width: 50%" scope="col">Date</th>
                    </tr>
                </thead>
                <tbody>
<?php
                    showActivity($conn, $_SESSION['userId'])
?>
                </tbody>
            </table>
        </div>
	</section>
    <div class="py-3"></div>
</div>
<?php
require_once(__ROOT__.'includes/errors.inc.php');
require_once(__ROOT__.'bases/footer.php');
?>