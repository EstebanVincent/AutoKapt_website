<?php
  $pathHeader = $_SERVER['DOCUMENT_ROOT'];
  $pathHeader .= '/AutoKapt/bases/header.php'; /* psq le / va voir la vrai root d'ou cette méthode */
  include_once($pathHeader);
?>

    <div id = "imagePrincipale">
      <h1>APP G9E</h1>
      <div id = "firstLine"></div>
      <h3>L'équipe</h3>
    </div>
   </header>   
    <div class="profiles">
      <div class="profile">
        <img src="/AutoKapt/images/10465.jpg" alt="Paul" class="profile-img">
        <h3 class = "user-name">Paul</h3>
        <div id="line"></div>
        <h5>Scribe</h5>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.
         Fugit, animi. Delectus dolores nihil vero dolorum molestiae
         consequatur alias eaque aut.</p>
         <a href="https://www.linkedin.com/in/paul-batut" class="fab fa-linkedin"></a>
      </div>
      <div class="profile">
        <img src="/AutoKapt/images/60116.jpg" alt="JP" class="profile-img">
        <h3 class = "user-name">Jean-Pascal</h3>
        <div id="line"></div>
        <h5>Référent</h5>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.
         Fugit, animi. Delectus dolores nihil vero dolorum molestiae
         consequatur alias eaque aut.</p>
         <a href="https://www.linkedin.com/in/jpvost/" class="fab fa-linkedin"></a>
      </div>
      <div class="profile">
        <img src="/AutoKapt/images/60115.jpg" alt="Esteban" class="profile-img">
        <h3 class = "user-name">Esteban</h3>
        <div id="line"></div>
        <h5>Animateur</h5>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.
         Fugit, animi. Delectus dolores nihil vero dolorum molestiae
         consequatur alias eaque aut.</p>
         <a href="https://www.linkedin.com/in/esvi/" class="fab fa-linkedin"></a>
      </div>
      <div class="profile">
        <img src="/AutoKapt/images/60376.jpg" alt="Julien" class="profile-img">
        <h3 class = "user-name">Julien</h3>
        <div id="line"></div>
        <h5>cadre</h5>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.
         Fugit, animi. Delectus dolores nihil vero dolorum molestiae
         consequatur alias eaque aut.</p>
         <a href="#" class="fab fa-linkedin"></a>
      </div>
      <div class="profile">
        <img src="/AutoKapt/images/61585.jpg" alt="Sofyane" class="profile-img">
        <h3 class = "user-name">Sofyane</h3>
        <div id="line"></div>
        <h5>cadre</h5>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.
         Fugit, animi. Delectus dolores nihil vero dolorum molestiae
         consequatur alias eaque aut.</p>
         <a href="#" class="fab fa-linkedin"></a>
      </div>
    </div>


<?php
  $pathFooter = $_SERVER['DOCUMENT_ROOT'];
  $pathFooter .= '/AutoKapt/bases/footer.php';/* psq le / va voir la vrai root d'ou cette méthode */
  include_once($pathFooter);
?>