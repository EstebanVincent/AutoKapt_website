<?php
  require_once($_SERVER['DOCUMENT_ROOT'].'/AutoKapt/bases/header.php');
?>

<section class="container-fluid bg-secondary text-white-50">

    <div class="row">
        <div class="col-sm-6">
            <h1>Infinite Measures</h1>
            
            <h2> <?php echo $lang['accueil-title2'] ?>:<br />
            <?php echo $lang['accueil-para1'] ?></h2>
           
            <p><?php echo $lang['accueil-para2'] ?> </p>
            
            <h3_2><?php echo $lang['accueil-title3'] ?></h3_2>

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

        </div>
        <div class="col-sm-6">
           <img src="/AutoKapt/images/vieux.jpg" class="img-responsive" /></div>
        </div>
    </div>
</section>

<?php
    require_once(__ROOT__.'bases/footer.php');
?>