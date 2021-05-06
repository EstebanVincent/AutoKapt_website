<?php
  require_once($_SERVER['DOCUMENT_ROOT'].'/AutoKapt/bases/header.php');
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
                        <td><a href="/AutoKapt/pages/User/play/p.stress.php"><button class="btn btn-danger"><i class="far fa-play-circle"></i> <?php echo $lang['play'] ?></button></a><a href="/AutoKapt/pages/User/result/stress.php"><button class="btn btn-danger"><i class="fas fa-chart-line"></i> Stats</button></a></td>
                        <td>sql a faire</td>
                    </tr>
                    <tr class="text-white-50">
                        <td><h5><?php echo $lang['dashboard-reflex'] ?></h5></td>
                        <td><a href="/AutoKapt/pages/User/play/p.reflex.php"><button class="btn btn-danger"><i class="far fa-play-circle"></i> <?php echo $lang['play'] ?></button></a><a href="/AutoKapt/pages/User/result/reflex.php"><button class="btn btn-danger"><i class="fas fa-chart-line"></i> Stats</button></a></td>
                        <td>sql a faire</td>
                    </tr>
                    <tr class="text-white-50">
                        <td><h5><?php echo $lang['dashboard-memory'] ?></h5></td>
                        <td><a href=""><button class="btn btn-danger"><i class="far fa-play-circle"></i> <?php echo $lang['play'] ?></button></a><a href="/AutoKapt/pages/User/result/memory.php"><button class="btn btn-danger"><i class="fas fa-chart-line"></i> Stats</button></a></td>
                        <td>sql a faire</td>
                    </tr>
                    <tr class="text-white-50">
                        <td><h5><?php echo $lang['dashboard-hearing'] ?></h5></td>
                        <td><a href=""><button class="btn btn-danger"><i class="far fa-play-circle"></i> <?php echo $lang['play'] ?></button></a><a href="/AutoKapt/pages/User/result/audition.php"><button class="btn btn-danger"><i class="fas fa-chart-line"></i> Stats</button></a></td>
                        <td>sql a faire</td>
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
require_once __ROOT__.'includes/functions.inc.php';

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