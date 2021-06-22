<?php
    require_once($_SERVER['DOCUMENT_ROOT'].'/AutoKapt/bases/header.php');
    require_once(__ROOT__.'Model/integration.inc.php');
    sendTrame(createTrame(1));/* demande de test de stress, température */
?>
<div class="container-fluid bg-secondary text-white-50">
    <div class="py-3"></div>
	<section class="dark2 py-2 mx-5 card">
        <div class="card-body">
            <div class="card-title text-center"><h2 class="fw-bold text-info">Mentions Légales</h2> </div>
            <p class="card-text text-center fs-4">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Architecto, vel. Magni blanditiis neque est odio nobis, nesciunt, ipsum molestias dolor alias, doloremque accusantium velit natus ut aut eum. Consequuntur, consequatur?</p>
        </div>
	</section>
    <div class="py-3"></div>
    <section class="dark2 py-2 mx-5 card">
        <div class="card-body">
            <p class="card-text text-center fs-4">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Fugit qui voluptate maxime exercitationem, unde corporis temporibus quia voluptas sit neque a maiores animi iure sapiente, dolores vero esse id optio. Eius asperiores voluptas consequuntur illum maxime dicta obcaecati cumque aut eaque vero labore, quas quasi quibusdam quos ab? Quaerat laboriosam incidunt cum sint debitis fuga, modi corporis mollitia officia nulla vero rerum autem reprehenderit consectetur ex aliquid? Fugiat saepe autem veniam, perferendis nemo, consectetur vitae mollitia modi debitis animi ipsum dignissimos molestiae a nesciunt tenetur fugit nostrum aperiam nam nulla. Eligendi commodi numquam quaerat odio itaque quos libero facilis cum facere soluta earum consequuntur, consequatur dolorem molestias cumque expedita eos asperiores quibusdam nobis dicta laborum molestiae veniam? Veritatis, similique dolorum. Commodi aliquam soluta aliquid unde dolorem dignissimos consectetur harum sapiente nesciunt rem, assumenda cum fugit nostrum! Atque amet optio asperiores ipsam explicabo dolores pariatur temporibus soluta fugiat minima sit voluptatem enim maiores laborum dicta quia nihil doloribus suscipit, ipsum hic. Alias repellat temporibus earum voluptatum, quaerat asperiores cupiditate architecto. Ea sunt omnis, quisquam reiciendis deleniti explicabo voluptate obcaecati aperiam necessitatibus nostrum error vitae facere dignissimos unde iste, illo eos pariatur officia facilis laboriosam incidunt itaque similique. Voluptate laboriosam exercitationem eaque!</p>
        </div>
	</section>
    <div class="py-3"></div>
</div>
<script src="/AutoKapt/js/integration.js"></script>

<?php
require_once(__ROOT__.'bases/footer.php');
?>