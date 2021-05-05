<!-- 
    fichier inclut dans tout les fichiers php vue par l'utilisateur sauf les forms de log In

    Il définit le footer du site
 -->

<?php
    require_once "config.php";
?>

<footer class="bg-dark text-center text-white-50">
    <div class="container">
        <section class="">
            <div class="row">
                <div class="col">
                    <h2><?php echo $lang['footer-title1'] ?></h2>
                    <p class="align-justify">
                        <?php echo $lang['footer-p'] ?>
                    </p>
                </div>
                <div class="col">
                    <h2><?php echo $lang['footer-title2'] ?></h2>
                    <ul class="list-unstyled">
                        <li>
                            <h5><?php echo $lang['footer-select'] ?></h5>
                            <form>
                                <select class="form-control form-control-sm text-white-50 bg-dark" onchange="location = this.value;">
<?php
                                if($_SESSION["lang"] == 'en'){
                                    echo 
                                    '
                                    <option value="/AutoKapt/includes/language/change2English.php">
                                        English
                                    </option>
                                    <option value="/AutoKapt/includes/language/change2French.php">
                                        Francais
                                    </option>';
                                
                                } else if($_SESSION["lang"] == 'fr'){
                                    echo 
                                    '
                                    <option value="/AutoKapt/includes/language/change2French.php">
                                        Francais
                                    </option>
                                    <option value="/AutoKapt/includes/language/change2English.php">
                                        English
                                    </option>';
                                }
?>
                                </select>
                            </form>
                        </li>
                        <li>
                            <h5><?php echo $lang['footer-follow'] ?></h5>
                            <!-- Facebook -->
                            <a class="btn btn-outline-secondary btn-floating m-1" href="#!" role="button"><i class="fab fa-facebook-f"></i></a>

                            <!-- Twitter -->
                            <a class="btn btn-outline-secondary btn-floating m-1" href="#!" role="button"><i class="fab fa-twitter"></i></a>

                            <!-- Google -->
                            <a class="btn btn-outline-secondary btn-floating m-1" href="#!" role="button"><i class="fab fa-google"></i></a>

                            <!-- Instagram -->
                            <a class="btn btn-outline-secondary btn-floating m-1" href="#!" role="button"><i class="fab fa-instagram"></i></a>

                            <!-- Linkedin -->
                            <a class="btn btn-outline-secondary btn-floating m-1" href="#!" role="button"><i class="fab fa-linkedin-in"></i></a>

                            <!-- Github -->
                            <a class="btn btn-outline-secondary btn-floating m-1" href="#!" role="button"><i class="fab fa-github"></i></a>

                            <!-- Youtube -->
                            <a class="btn btn-outline-secondary btn-floating m-1" target="_blank" rel="noopener noreferrer" href="https://www.youtube.com/watch?v=dQw4w9WgXcQ" role="button"><i class="fab fa-youtube"></i></a>
                        </li>
                    </ul>
                </div>
                <div class="col text-start">
                    <h2><?php echo $lang['footer-title3'] ?></h2>
                    <ul class="list-unstyled">
                        <li>
                            <h5><?php echo $lang['footer-faq'] ?></h5>
                            <a href="/AutoKapt/pages/faq.php" class="text-white-50">FAQ</a>
                        </li>
                        <li>
                            <h5>CONTACT</h5>
                            <a href="#!" class="text-white-50 text-start"><?php echo $lang['footer-contact'] ?></a>
                        </li>
                        <li>
                            <h5><?php echo $lang['footer-title4'] ?></h5>
                            <a href="#!" class="text-white-50 text-start">CGU</a><br>
                            <a href="#!" class="text-white-50 text-start"><?php echo $lang['footer-mention'] ?></a>
                        </li>
                    </ul>
                </div>
            </div>
        </section>
    </div>
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2)">
        @ Powered by : AutoKapt <img src="/AutoKapt/images/logo2.png" class="logo2" />
    </div>
</footer>

</body>
</html>


