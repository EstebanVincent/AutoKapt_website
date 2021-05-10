<?php
  require_once($_SERVER['DOCUMENT_ROOT'].'/AutoKapt/bases/header.php');
?>

<div id = "imagePrincipale">
      <h1>APP G9E</h1>
      <div id = "firstLine"></div>
      <h3>Les différents tests</h3>



  <div class="testpagemain">
  
    <div class="testpage rounded" >
      <img src="/AutoKapt/images/stress.jpg" alt="ImgStress" class="testpage-imgL"></img>
        <div>
        <p class = "testpage-titre">Mesure du stresse</p>
        <p class="testpage-text">Il vous sera demandé de placer votre doigt dans un tube opaque qui déterminera votre rythme cardiaque par transparence au travers dudit doigt.
         Il vous sera également demandé de pincer un capteur de température entre vos doigts pour informer le système de votre température corporelle actuelle.
          Ces données permettront ainsi de déterminer votre niveau de stress.</p>
         </div>
    </div>

    <div class="testpage rounded">
        <div>
        <p class = "testpage-titre">Mesure des réflexes</p>
        <p class="testpage-text">Vos réflexes seront évalués face à des stimuli auditifs et visuels.
         Les premiers seront effectués au moyen d’un signal lumineux, les deuxièmes avec un son dans votre casque.
          Vous devrez ainsi appuyer sur le bouton devant vous dès que vous entendez ou voyez le signal pour que le système en déduise votre temps de réaction.</p>
         </div>
         <img src="/AutoKapt/images/reflexe.png" alt="ImgReflexe" class="testpage-imgR"></img>

    </div>    

    <div class="testpage rounded">
      <img src="/AutoKapt/images/memoire.jpg" alt="ImgMemoire" class="testpage-imgL"></img>
        <div>
        <p class = "testpage-titre">Tests de mémoire</p>
        <p class="testpage-text">Le test de mémoire consiste en un rythme qui vous sera montré au moyen de signaux lumineux ou sonores,
         vous devrez ensuite reproduire ce rythme à l’aide du bouton. Vous optiendrez ainsi un score sur 100 indiquant la fidélité au rythme de base.</p>
         </div>
    </div>  

    <div class="testpage rounded">
        <div>
        <p class = "testpage-titre">Tests d'audition</p>
        <p class="testpage-text">Le test d’audition enverra dans votre casque une note,
         vous devrez ainsi reproduire cette note dans le microphone le plus fidèlement possible à l’aide de votre smartphone.
         Il vous sera ainsi attribué un score sur 100 en fonction de la fidélité à la note initiale.</p>
         </div>
         <img src="/AutoKapt/images/audition.png" alt="ImgAudition" class="testpage-imgR"></img>

    </div> 
   
  </div>


<?php
    require_once(__ROOT__.'bases/footer.php');
?>