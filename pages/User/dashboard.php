<?php
  require_once($_SERVER['DOCUMENT_ROOT'].'/AutoKapt/bases/header.php');
?>
<div class="container-fluid bg-secondary text-white-50">
	<div class="py-3"></div>
	<section class="dark2 py-2 mx-5 card">
        <div class="card-body">
            <div class="card-title"><b>Dashboard</b> </div>
            <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequatur ipsa quam excepturi autem animi, eveniet maxime dolor, iste odio, est laudantium consectetur possimus magni veritatis tenetur incidunt illum aperiam quos!</p>
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
                        <td><a href="/AutoKapt/pages/User/play/p.stress.php"><button class="btn btn-danger"><i class="far fa-play-circle"></i> Play</button></a><a href="/AutoKapt/pages/User/result/stress.php"><button class="btn btn-danger"><i class="fas fa-chart-line"></i> Stats</button></a></td>
                        <td>@mdo</td>
                    </tr>
                    <tr class="text-white-50">
                        <td><h5>Reflex</h5></td>
                        <td><a href=""><button class="btn btn-danger"><i class="far fa-play-circle"></i> Play</button></a><a href="/AutoKapt/pages/User/result/reflex.php"><button class="btn btn-danger"><i class="fas fa-chart-line"></i> Stats</button></a></td>
                        <td>@fat</td>
                    </tr>
                    <tr class="text-white-50">
                        <td><h5>Memory</h5></td>
                        <td><a href=""><button class="btn btn-danger"><i class="far fa-play-circle"></i> Play</button></a><a href="/AutoKapt/pages/User/result/memory.php"><button class="btn btn-danger"><i class="fas fa-chart-line"></i> Stats</button></a></td>
                        <td>@twitter</td>
                    </tr>
                    <tr class="text-white-50">
                        <td><h5>Audition</h5></td>
                        <td><a href=""><button class="btn btn-danger"><i class="far fa-play-circle"></i> Play</button></a><a href="/AutoKapt/pages/User/result/audition.php"><button class="btn btn-danger"><i class="fas fa-chart-line"></i> Stats</button></a></td>
                        <td>@twitter</td>
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
require_once __ROOT__.'includes/dataBaseHandler.inc.php';
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