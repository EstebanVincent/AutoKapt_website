<?php
  $pathHeader = $_SERVER['DOCUMENT_ROOT'];
  $pathHeader .= '/AutoKapt/bases/header.php'; /* psq le / va voir la vrai root d'ou cette méthode */
  include_once($pathHeader);
?>
    <div id="imagePrincipale">
      <h1>APP G9E</h1>
      <div id="firstLine"></div>
      <h3>Notre projet</h3>
    </div>
  </header>

  <section id="presentation">
    <div id="txtIntro">
      <h2>Une équipe, un projet</h2>
      <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit.
        Non, suscipit? Vitae culpa esse, animi voluptatibus voluptas
        non cupiditate ea soluta quo. Distinctio culpa, fugit excepturi
        id molestiae enim consequatur adipisci porro maiores, esse omnis
        a, aspernatur iste illum tempora eaque?</p>
    </div>
    <div id="prestation">
      <div class="imagesPresations">
        <h4>Nous trouver</h4>
        <a href="#"><img src="images/background.jpg" alt="background"></a>
      </div>
      <div class="imagesPresations">
        <h4>Test</h4>
        <a href="#"><img src="images/leaf.jpg" alt="leaf"></a>
      </div>
    </div>
  </section>
  <section id="passer le test">

  </section>

  <?php
  $pathFooter = $_SERVER['DOCUMENT_ROOT'];
  $pathFooter .= '/AutoKapt/bases/footer.php';/* psq le / va voir la vrai root d'ou cette méthode */
  include_once($pathFooter);
?>