<?php
  require_once($_SERVER['DOCUMENT_ROOT'].'/AutoKapt/bases/header.php');
?>

<section class="container-fluid bg-secondary text-white-50">

    <div class="row">
        <div class="col-sm-1"></div>
        <div class="col-sm-10">
            <div class="py-3"></div>
            <section class="dark2 py-2 mx-5 card">
                <div class="card-body">
                    <div class="card-title text-center pt-2"><h2 class="fw-bold text-info"><?php echo $lang['accueil-title2'] ?></h2> </div>
                    <p class="card-text text-center text-info fs-4"><?php echo $lang['accueil-para1'] ?></p>
                </div>
            </section>
            <div class="py-3"></div>
            
           
            <!-- <p><?php echo $lang['accueil-para2'] ?> </p> -->
            <!-- <img src="/AutoKapt/images/vieux.jpg" class="img-responsive center rounded" /><br> -->

            <section class="dark2 py-2 mx-5 card">
                <img src="/AutoKapt/images/vieux.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <div class="card-title"><b><?php echo $lang['accueil-title3'] ?></b> </div>
                    <p class="card-text">
                        <ul class="justify">
                            <li><strong> <?php echo $lang['accueil-pilier1'] ?></strong><br />
                            <?php echo $lang['accueil-para3']  ?></li>
                            <br />
                            <li><strong> <?php echo $lang['accueil-pilier2'] ?></strong><br />   
                            <?php echo $lang['accueil-para4'] ?></li>
                            <br />
                            <li><strong><?php echo $lang['accueil-pilier3'] ?></strong><br />
                            <?php echo $lang['accueil-para5'] ?></li>
                        </ul>
                    </p>
                </div>
            </section>
            <div class="py-3"></div>
        </div>
        <div class="col-sm-1"></div>
    </div>
</section>

<?php
    require_once(__ROOT__.'bases/footer.php');
?>