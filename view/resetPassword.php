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

        <!-- Sign up form -->
        <section class="signup">
            <div class="container">
                <div class="signup-content">
                    <div class="signup-form">
                        <h2 class="form-title">Reset password</h2>
                        <form target="_blank" action="?action=reset_password" method="POST" class="register-form" id="register-form">
                            <div class="form-group">
                                <label for="mail"><i class="zmdi zmdi-email"></i></label>
                                <input type="email" name="mail" id="mail" placeholder="Your Email"/>
                            </div>
                            <?php
                                if(isset($_SESSION['error'])){
                                    if($_SESSION['error']=='invalid_mail'){ echo '<div style="color:red">Email invalide !</div>'; }
                                }
                            ?>
                            <div class="form-group form-button">
                                <input type="submit" name="signup" id="signup" class="form-submit" value="Reset"/>
                            </div>
                        </form>
                    </div>
                    <div class="signup-image">
                        <figure><img src="assets/images/signup-image.jpg" alt="sing up image"></figure>
                        <a href="?action=login" class="signup-image-link">I am already member</a>
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