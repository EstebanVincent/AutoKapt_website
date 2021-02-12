<?php
  $pathHeader = $_SERVER['DOCUMENT_ROOT'];
  $pathHeader .= '/AutoKapt/bases/header.php'; /* psq le / va voir la vrai root d'ou cette méthode */
  include_once($pathHeader);
?>
        <div id = "imagePrincipale">
          <h1>APP G9E</h1>
          <div id = "firstLine"></div>
          <h3>Foire aux Questions</h3>
        </div>
       </header>  

       
<?php
  $pathFooter = $_SERVER['DOCUMENT_ROOT'];
  $pathFooter .= '/AutoKapt/bases/footer.php';/* psq le / va voir la vrai root d'ou cette méthode */
  include_once($pathFooter);
?>