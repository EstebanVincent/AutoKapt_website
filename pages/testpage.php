<?php
  require_once($_SERVER['DOCUMENT_ROOT'].'/AutoKapt/bases/header.php');
?>

<div id = "imagePrincipale">
      <h1>APP G9E</h1>
      <div id = "firstLine"></div>
      <h3><?php echo $lang['testdesc-maintitle'] ?></h3>



  <div class="testpagemain">
  
    <div class="testpage rounded" >
      <img src="/AutoKapt/images/stress.jpg" alt="ImgStress" class="testpage-imgL"></img>
        <div>
        <p class = "testpage-titre"><?php echo $lang['testdesc-stress-title'] ?></p>
        <p class="testpage-text"><?php echo $lang['testdesc-stress-desc'] ?></p>
         </div>
    </div>

    <div class="testpage rounded">
        <div>
        <p class = "testpage-titre"><?php echo $lang['testdesc-reflex-title'] ?></p>
        <p class="testpage-text"><?php echo $lang['testdesc-reflex-desc'] ?></p>
         </div>
         <img src="/AutoKapt/images/reflexe.png" alt="ImgReflexe" class="testpage-imgR"></img>

    </div>    

    <div class="testpage rounded">
      <img src="/AutoKapt/images/memoire.jpg" alt="ImgMemoire" class="testpage-imgL"></img>
        <div>
        <p class = "testpage-titre"><?php echo $lang['testdesc-memory-title'] ?></p>
        <p class="testpage-text"><?php echo $lang['testdesc-memory-desc'] ?></p>
         </div>
    </div>  

    <div class="testpage rounded">
        <div>
        <p class = "testpage-titre"><?php echo $lang['testdesc-audition-title'] ?></p>
        <p class="testpage-text"><?php echo $lang['testdesc-audition-desc'] ?></p>
         </div>
         <img src="/AutoKapt/images/audition.png" alt="ImgAudition" class="testpage-imgR"></img>

    </div> 
   
  </div>


<?php
    require_once(__ROOT__.'bases/footer.php');
?>