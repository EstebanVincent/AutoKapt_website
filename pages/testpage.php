<?php
  require_once($_SERVER['DOCUMENT_ROOT'].'/AutoKapt/bases/header.php');
?>

<div class="container-fluid bg-secondary text-white-50">
	<div class="py-3"></div>
  <div class="testpagemain">
    <div class="testpage-title rounded dark2" >
        <div class="text-center">
        <p class = "testpage-titre text-info"><?php echo $lang['testdesc-title'] ?></p>
        <p class="testpage-text text-info"><?php echo $lang['testdesc-desc'] ?></p>
         </div>
    </div>
    <div class="testpage rounded dark2" >
      <img src="/AutoKapt/images/stress.jpg" alt="ImgStress" class="testpage-imgL"></img>
        <div>
        <p class = "testpage-titre text-white-50 ms-4"><?php echo $lang['testdesc-stress-title'] ?></p>
        <p class="testpage-text text-white-50 justify"><?php echo $lang['testdesc-stress-desc'] ?></p>
         </div>
    </div>

    <div class="testpage rounded dark2">
        <div>
        <p class = "testpage-titre text-white-50 ms-4"><?php echo $lang['testdesc-reflex-title'] ?></p>
        <p class="testpage-text text-white-50 justify"><?php echo $lang['testdesc-reflex-desc'] ?></p>
         </div>
         <img src="/AutoKapt/images/reflexe.png" alt="ImgReflexe" class="testpage-imgR"></img>

    </div>    

    <div class="testpage rounded dark2">
      <img src="/AutoKapt/images/memoire.jpg" alt="ImgMemoire" class="testpage-imgL"></img>
        <div>
        <p class = "testpage-titre text-white-50 ms-4"><?php echo $lang['testdesc-memory-title'] ?></p>
        <p class="testpage-text text-white-50 justify"><?php echo $lang['testdesc-memory-desc'] ?></p>
         </div>
    </div>  

    <div class="testpage rounded dark2">
        <div>
        <p class = "testpage-titre text-white-50 ms-4"><?php echo $lang['testdesc-audition-title'] ?></p>
        <p class="testpage-text text-white-50 justify"><?php echo $lang['testdesc-audition-desc'] ?></p>
         </div>
         <img src="/AutoKapt/images/audition.png" alt="ImgAudition" class="testpage-imgR"></img>

    </div> 
   
  </div>
</div>

<?php
    require_once(__ROOT__.'bases/footer.php');
?>