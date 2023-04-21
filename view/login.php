<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up Form by Colorlib</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="assets/fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

    <div class="main">


        <!-- Sing in  Form -->
        <section class="sign-in">
            <div class="container">
                <div class="signin-content">
                    <div class="signin-image">
                        <figure><img src="assets/images/signin-image.jpg" alt="sing up image"></figure>
                        <a href="?action=signup" class="signup-image-link">Create an account</a>
                    </div>

                    <div class="signin-form">
                        <h2 class="form-title">Login</h2>
                        <form action="?action=login_php" method="POST" class="register-form" id="login-form">
                            <div class="form-group">
                                <label for="mail"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="email" name="mail" id="mail" placeholder="Your mail"/>
                            </div>
                            <div class="form-group relative">
                                <label for="=password"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="password" id="password" placeholder="Password"/>
                            </div>
                            <?php
                            if(isset($_SESSION['error'])){
                                if($_SESSION['error']=='invalid_mail'){ echo '<div style="color:red">Email invalide !</div>'; }
                                if($_SESSION['error']=='missing_mail'){ echo '<div style="color:red">Cet email n\'est lié à aucun compte !</div>'; }
                                if($_SESSION['error']=='invalid_password'){ echo '<div style="color:red">Mot de passe incorrect !</div>'; }
                            } ?>
                            <div class="form-group form-button">
                                <input type="submit" name="signin" id="signin" class="form-submit" value="Log in"/>
                            </div>
                            <a href="?action=reset_password">Mot de passe oublié ?</a>
                        </form>
                        <div class="social-login">
                            <span class="social-label">Or login with</span>
                            <ul class="socials">
                                <li><a href="#"><i class="display-flex-center zmdi zmdi-facebook"></i></a></li>
                                <li><a href="#"><i class="display-flex-center zmdi zmdi-twitter"></i></a></li>
                                <li><a href="#"><i class="display-flex-center zmdi zmdi-google"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>

    <!-- JS -->
    <srcipt src="assets/vendor/jquery/jquery.min.js"></srcipt>
    <srcipt src="assets/js/main.js"></srcipt>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>

<?php
unset($_SESSION['error']);
?>