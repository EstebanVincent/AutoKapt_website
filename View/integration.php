<?php
    require_once($_SERVER['DOCUMENT_ROOT'].'/AutoKapt/bases/header.php');
    require_once(__ROOT__.'Model/integration.inc.php');
    /* sendTrame(createTrame(1)); */
?>
<div class="container-fluid bg-secondary text-white-50">
    <div class="py-3"></div>
    <section class="dark2 py-2 mx-5 card">
        <div class="card-body">
            <div class="card-title text-center">
                <h2 class="fw-bold text-info">Résultats</h2>
                <p>Il est nécessaire de réaliser les 2 tests à la suite</p>
            </div>
                <div class="row">
                    <div class="col-6 text-center">
                        <h4>BPM</h4><br>
                        <button id="bpmAsk" type="button" class="btn btn-primary" name="bpmAsk" value="bpmAsk">Appuyer pour prévenir la carte</button><br><br>
                        <div class="bpmAsk"></div>
                        <button id="bpmStart" type="button" class="btn btn-primary">Appuyer sur le bouton de la carte avant de cliquer</button>
                        <p id="bpmCountdown"></p>
                        <div class="bpmResult"></div>
                    </div>
                    <div class="col-6 text-center">
                        <h4>Température</h4><br>
                        <button id="tempAsk" type="button" class="btn btn-primary" name="tempAsk" value="tempAsk">Appuyer pour prévenir la carte</button><br><br>
                        <div class="tempAsk"></div>
                        <button id="tempStart" type="button" class="btn btn-primary">Click once you have clicked on the button</button>
                        <p id="tempCountdown"></p>
                        <div class="tempResult"></div>
                    </div>
                </div>
                <div class="py-3"></div>
                <div class="text-center">
                    <button id="saveStress" type="button" class="btn btn-primary" name="saveStress" value="saveStress">Appuyer pour sauvegarder les résultats</button><br><br>
                    <div class="saveStress"></div>
                </div>
            <div class="test"></div>
        </div>
	</section>
    <div class="py-3"></div>
</div>
<script src="/AutoKapt/js/integration.js"></script>

<?php
require_once(__ROOT__.'bases/footer.php');
?>