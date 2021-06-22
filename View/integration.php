<?php
    require_once($_SERVER['DOCUMENT_ROOT'].'/AutoKapt/bases/header.php');
    require_once(__ROOT__.'Model/integration.inc.php');
    sendTrame(createTrame(1));/* demande de test de stress, température */
?>
<div class="container-fluid bg-secondary text-white-50">
    <div class="py-3"></div>
	<section class="dark2 py-2 mx-5 card">
        <div class="card-body">
            <div class="card-title text-center"><h2 class="fw-bold text-info">Inté</h2> </div>
        </div>
	</section>
    <div class="py-3"></div>
    <section class="dark2 py-2 mx-5 card">
        <div class="card-body">
            
            <div class="test"></div>
            
<button id="gameStart">Click once you have clicked on the button</button>
<p id="countdown"></p>
<div class="data"></div>
        </div>
	</section>
    <div class="py-3"></div>
</div>
<script src="/AutoKapt/js/integration.js"></script>

<?php
require_once(__ROOT__.'bases/footer.php');
?>