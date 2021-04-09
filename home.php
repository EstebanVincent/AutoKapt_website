<?php
  $pathHeader = $_SERVER['DOCUMENT_ROOT'];
  $pathHeader .= '/AutoKapt/bases/header.php'; /* psq le / va voir la vrai root d'ou cette méthode */
  include_once($pathHeader);
?>

<section class="container">
    <div class="row">
        <div class="col-sm-6">
            <h1>Infinite Measures</h1>
            <p>Home</p>
            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit.
            Non, suscipit? Vitae culpa esse, animi voluptatibus voluptas
            non cupiditate ea soluta quo. Distinctio culpa, fugit excepturi
            id molestiae enim consequatur adipisci porro maiores, esse omnis
            a, aspernatur iste illum tempora eaque?</p>
        </div>
        <div class="col-sm-6">
            <img src="/AutoKapt/images/background.jpg" class="img-responsive" />
        </div>
    </div>
</section>

<?php
  $pathFooter = $_SERVER['DOCUMENT_ROOT'];
  $pathFooter .= '/AutoKapt/bases/footer.php';/* psq le / va voir la vrai root d'ou cette méthode */
  include_once($pathFooter);
?>