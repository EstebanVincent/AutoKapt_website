<footer class="bg-dark text-center text-white">
            <div class="container p-4">
                <!-- Section: Social media -->
                <section class="mb-4">
                    <!-- Facebook -->
                    <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"><i class="fab fa-facebook-f"></i></a>

                    <!-- Twitter -->
                    <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"><i class="fab fa-twitter"></i></a>

                    <!-- Google -->
                    <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"><i class="fab fa-google"></i></a>

                    <!-- Instagram -->
                    <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"><i class="fab fa-instagram"></i></a>

                    <!-- Linkedin -->
                    <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"><i class="fab fa-linkedin-in"></i></a>

                    <!-- Github -->
                    <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"><i class="fab fa-github"></i></a>
                </section>
                <section class="">
                    <form action="">
                        <div class="row d-flex justify-content-center">
                            <div class="col-auto">
                                <p class="pt-2">
                                    <strong>Sign up for our newsletter</strong>
                                </p>
                            </div>
                            <div class="col-md-5 col-12">
                                <div class="form-outline form-white mb-4">
                                    <input type="email" id="form5Example2" class="form-control" />
                                    <label class="form-label" for="form5Example2">Email address</label>
                                </div>
                            </div>
                            <div class="col-auto">
                                <button type="submit" class="btn btn-outline-light mb-4">Subscribe</button>
                            </div>
                        </div>
                    </form>
                </section>
                <section class="mb-4">
                    <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt distinctio earum repellat quaerat voluptatibus placeat
                        nam, commodi optio pariatur est quia magnam eum harum corrupti dicta, aliquam sequi voluptate quas.
                    </p>
                </section>
                <section class="">
                    <div class="row">
                        <div class="col">
                            <h2>About</h2>
                            <p>
                                Lorem ipsum, dolor sit amet consectetur adipisicing elit. Eos neque incidunt voluptatem fuga impedit modi
                                voluptate? Voluptates, exercitationem, beatae sapiente nam excepturi temporibus odit possimus ratione quo
                                fugit iure. Sit.
                            </p>
                        </div>
                        <div class="col">
                            <h2>JSP lol</h2>
                            <h5>LANGUAGE SELECT</h5>
                            <form>
                                <select class="form-control form-control-sm text-white bg-dark" onchange="location = this.value;">
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
                        </div>
                        <div class="col text-start">
                            <h2>Need some help?</h2>
                            <ul class="list-unstyled">
                                <li>
                                    <h5>COMMONLY ASKED QUESTIONS</h5>
                                    <a href="/AutoKapt/pages/faq.php" class="text-white">FAQ</a>
                                </li>
                                <li>
                                    <h5>CONTACT</h5>
                                    <a href="#!" class="text-white text-start">Contact Us by Email</a>
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


