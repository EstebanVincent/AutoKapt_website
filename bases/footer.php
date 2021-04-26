<!-- 
    fichier inclut dans tout les fichiers php vue par l'utilisateur sauf les forms de log In

    Il définit le footer du site
 -->
<footer class="bg-dark text-center text-white-50">
    <div class="container">
        <section class="">
            <div class="row">
                <div class="col">
                    <h2>About</h2>
                    <p class="align-justify">
                        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Eos neque incidunt voluptatem fuga impedit modi
                        voluptate? Voluptates, exercitationem, beatae sapiente nam excepturi temporibus odit possimus ratione quo
                        fugit iure. Sit.
                    </p>
                </div>
                <div class="col">
                    <h2>JSP lol</h2>
                    <ul class="list-unstyled">
                        <li>
                            <h5>LANGUAGE SELECT</h5>
                            <form>
                                <select class="form-control form-control-sm text-white-50 bg-dark" onchange="location = this.value;">
<?php
                                if($_SESSION["userLanguage"] == 1){
                                    echo 
                                    '
                                    <option value="/AutoKapt/includes/language/change2English.php">
                                        English
                                    </option>
                                    <option value="/AutoKapt/includes/language/change2French.php">
                                        Francais
                                    </option>';
                                
                                } else if($_SESSION["userLanguage"] == 0){
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
                            <h5>FOLLOW US ON</h5>
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
                        </li>
                    </ul>
                </div>
                <div class="col text-start">
                    <h2>Need some help?</h2>
                    <ul class="list-unstyled">
                        <li>
                            <h5>COMMONLY ASKED QUESTIONS</h5>
                            <a href="/AutoKapt/pages/faq.php" class="text-white-50">FAQ</a>
                        </li>
                        <li>
                            <h5>CONTACT</h5>
                            <a href="#!" class="text-white-50 text-start">Contact Us by Email</a>
                        </li>
                        <li>
                            <h5>JSP</h5>
                            <a href="#!" class="text-white-50 text-start">CGU</a><br>
                            <a href="#!" class="text-white-50 text-start">Mentions Légales</a>
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


