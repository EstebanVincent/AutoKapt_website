<!DOCTYPE php>
<?php
  $pathHeader = $_SERVER['DOCUMENT_ROOT'];
  $pathHeader .= '/AutoKapt/bases/header.php'; /* psq le / va voir la vrai root d'ou cette méthode */
  include_once($pathHeader);
?>

<div id = "imagePrincipale">
      <h1>APP G9E</h1>
      <div id = "firstLine"></div>
      <h3>Test Page</h3>



  <div class="testpagemain">

    <div class="testpage">
      <img src="/AutoKapt/images/reflexe.png" alt="ImgReflexe" class="testpage-imgL"></img>
        <div>
        <p class = "testpage-titre">Mesure des réflexes</p>
        <p class="testpage-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit.
         Fugit, animi. Delectus dolores nihil vero dolorum molestiae
         consequatur alias eaque aut.</p>
         </div>
    </div>

    <div class="testpage">
        <div>
        <p class = "testpage-titre">Mesure des réflexes</p>
        <p class="testpage-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit.
         Fugit, animi. Delectus dolores nihil vero dolorum molestiae
         consequatur alias eaque aut.</p>
         </div>
         <img src="/AutoKapt/images/reflexe.png" alt="ImgReflexe" class="testpage-imgR"></img>

    </div>    
    
    <div class="testpage">
      <img src="/AutoKapt/images/reflexe.png" alt="ImgReflexe" class="testpage-imgL"></img>
        <div>
        <p class = "testpage-titre">Mesure des réflexes</p>
        <p class="testpage-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit.
         Fugit, animi. Delectus dolores nihil vero dolorum molestiae
         consequatur alias eaque aut.</p>
         </div>
    </div>  
  </div>


<?php
  $pathFooter = $_SERVER['DOCUMENT_ROOT'];
  $pathFooter .= '/AutoKapt/bases/footer.php';/* psq le / va voir la vrai root d'ou cette méthode */
  include_once($pathFooter);
?>